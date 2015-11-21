<?php namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Http\Requests\CreateMessage;
use App\Src\User\UserRepository;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread as Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Services\PusherWrapper as Pusher;
use App\Src\User\User;

class MessagesController extends PrimaryController
{

    /**
     * @var Pusher
     */
    protected $pusher;
    protected $thread;
    protected $userRepository;

    public function __construct(Pusher $pusher, Thread $thread, UserRepository $userRepository)
    {
        $this->pusher = $pusher;
        $this->thread = $thread;
        $this->userRepository = $userRepository;
    }

    /**
     * Show all of the message threads to the user
     *
     * @return mixed
     */
    public function index()
    {

        $this->getPageTitle('message.index');

        $this->authorize('index', Session::get('module'));

        $currentUserId = Auth::user()->id;

        // All threads that user is participating in
        $threads = $this->thread->forUser($currentUserId)->with('participants', 'messages',
            'participants.user')->orderBy('created_at')->get();

        return view('backend.modules.messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {

        $this->getPageTitle('message.show');
        try {

            $thread = $this->thread->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->action('Backend\MessagesController@show', $id);
        }

        // don't show the current user in list
        $userId = Auth::user()->id;

        $usersList = User::whereNotIn('id', $thread->participantsUserIds($userId))->get()->lists('name', 'id');

        $thread->markAsRead($userId);

        return view('backend.modules.messenger.show', compact('thread', 'usersList'));
    }

    /**
     * Creates a new message thread
     *
     * @return mixed
     */
    public function create()
    {

        $this->authorize('create', 'message_create');

        $this->getPageTitle('message.create');


        $title = '';

        if (Input::get('book_id')) {

            $title .= trans('general.book_number') . Input::get('book_serial');

        }

        if (Input::get('chapter_id')) {
            $title .= trans('general.chapter_number') . Input::get('chapter_id');
        }


        $users = $this->userRepository->model->where('id', '!=', Auth::id())->get();

        $subjectList = [
            trans('general.general') => trans('general.general'),
            trans('general.abuse') => trans('general.abuse'),
            trans('general.preview') => trans('general.preview')
        ];

        $usersList = $users->lists('name', 'id');

        return view('backend.modules.messenger.create', compact('usersList', 'subjectList', 'title'));
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function store(CreateMessage $reqest)
    {
        if (!Input::has('recipients')) {
            return redirect()->back()->with(['error' => 'messages.error.not_allowed']);
        }
        $input = Input::all();

        $thread = $this->thread->create(
            [
                'subject' => Input::get('title') . ' : ' . Input::get('subject'),
            ]
        );

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id' => Auth::user()->id,
                'body' => $input['message'],
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id' => Auth::user()->id,
                'last_read' => new Carbon
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants($input['recipients']);
        }

        $this->oooPushIt($message);

        Session::forget('book_id');

        return redirect()->action('Backend\MessagesController@index');
    }

    /**
     * Adds a new message to a current thread
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {

        try {
            $thread = $this->thread->findOrFail($id);

        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->action('Backend\MessagesController@index');
        }


        $thread->activateAllParticipants();

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id' => Auth::id(),
                'body' => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id' => Auth::user()->id
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();


        // Recipients
        if (Input::has('recipients')) {


            $thread->addParticipants(Input::get('recipients'));
        }

        $this->oooPushIt($message);

        //return 'here';
        return redirect()->action('Backend\MessagesController@show', $id);
    }

    /**
     * Send the new message to Pusher in order to notify users
     *
     * @param Message $message
     */
    protected function oooPushIt(Message $message)
    {
        $thread = $message->thread;
        $sender = $message->user;

        $data = [
            'thread_id' => $thread->id,
            'div_id' => 'thread_' . $thread->id,
            'sender_name' => $sender->first_name,
            'thread_url' => action('Backend\MessagesController@show', ['id' => $thread->id]),
            'thread_subject' => $thread->subject,
            'html' => view('backend.modules.messenger.html-message', compact('message'))->render(),
            'text' => str_limit($message->body, 50)
        ];

        $recipients = $thread->participantsUserIds();
        if (count($recipients) > 0) {
            foreach ($recipients as $recipient) {
                if ($recipient == $sender->id) {
                    continue;
                }

                $this->pusher->trigger('for_user_' . $recipient, 'new_message', $data);
            }
        }
    }

    /**
     * Mark a specific thread as read, for ajax use
     *
     * @param $id
     */
    public function read($id)
    {
        $thread = $this->thread->find($id);
        if (!$thread) {
            abort(404);
        }

        $thread->markAsRead(Auth::id());
    }

    /**
     * Get the number of unread threads, for ajax use
     *
     * @return array
     */
    public function unread()
    {
        $count = Auth::user()->newMessagesCount();

        return ['msg_count' => $count];
    }

    public function cancel($threadId)
    {

        $deleted = DB::table('participants')->where(['thread_id' => $threadId, 'user_id' => Auth::id()])->delete();

        if ($deleted) {

            return redirect()->back()->with(['sucesss' => 'messages.success.message_deleted']);
        }

        return redirect()->back()->with(['error' => 'messages.error.error_occured']);

    }


}
