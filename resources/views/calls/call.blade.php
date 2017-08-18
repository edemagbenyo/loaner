<div class="modal fade bs-example-modal-lg" id="makeCall" role="dialog"
     aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Make call</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('calls.store')}}" id="callForm" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="control-label">Client</label>
                                <select name="client_id" id="clients" class="form-control client_id" data-url="{{route('api.client')}}">
                                    <option value="">Select a client</option>
                                    @foreach($clients as $c)
                                        <option value="{{$c->id}}" >{{$c->name}}</option>
                                    @endforeach
                                </select>
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Date Time</label>
                                <input type="text" id="datepicker" class="form-control call-date">
                                <label for="name" class="control-label">Enquiry</label>
                                <textarea name="enquiry" id="enquiry" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <label for="" class="control-label">Contact</label>
                                <input type="text" id="contact" name="contact" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="control-label">Action</label>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <textarea name="action" id="action" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">


                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Result</label>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <textarea name="result" id="result" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary save-call" value="Save">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div></form>
        </div>
    </div>
</div>