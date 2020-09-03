<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    protected $userRepository;
    protected $database;
    protected $firebase;

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/../../chatroom-d5296-firebase-adminsdk-p7aei-08eb0b05ed.json'); // đường dẫn của file json ta vừa tải phía trên
        $this->firebase           = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://chatroom-d5296.firebaseio.com/') //bạn có thẻ lấy project id ở mục project setting > general
            ->create();

        $this->database = $this->firebase->getDatabase();

        $this->userRepository = $this->database->getReference('booking_1'); //lấy model user.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $updates = [
            'name' => 'vjvjvjvj',
            'text' => 'vu linh hihihihihiihihih'
        ];

        $this->userRepository // this is the root reference
        ->update($updates);
        dd($this->userRepository->getValue());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
