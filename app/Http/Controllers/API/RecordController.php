<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\RecordRepositoryInterface;
use App\Http\Requests\RecordValidator;
use App\Http\Resources\RecordResource;

class RecordController extends Controller
{

    private $recordRepository;

    public function __construct(RecordRepositoryInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $records = $this->recordRepository->all();
            return RecordResource::collection($records);
        }catch(Exception $ex){
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordValidator $request)
    {
        try{
            $record = $this->recordRepository->create($request->all());
            return (new RecordResource($record))->additional(["success" => true]);;
        }catch(Exception $ex){
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $record = $this->recordRepository->show($id);
            if($record == null)
                return (new RecordResource(null))->additional(["success" => false, 'message' => 'Record not Found']);
            
            return (new RecordResource($record))->additional(["success" => true]);
    
        }catch(Exception $ex){
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
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
    public function update(RecordValidator $request, $id)
    {
        try{
            $record = $this->recordRepository->show($id);
            if($record == null)
                return (new RecordResource(null))->additional(["success" => false, 'message' => 'Record not Found']);
            
            $updated_record = $this->recordRepository->update($id, $request->all());

            return (new RecordResource($updated_record))->additional(["success" => true]);
    
        }catch(Exception $ex){
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $status = $this->recordRepository->deleteById($id);
           
            return (new RecordResource(null))->additional(["success" => $status]);
    
        }catch(Exception $ex){
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }
}
