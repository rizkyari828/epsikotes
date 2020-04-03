<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h5 class="modal-title">Process to cancel</h5>
</div>
<div class="modal-body no-padding">
    <form action="{{url('')}}/cancelSchedule" method="post" id="login-form" class="smart-form">
        <fieldset>
            <div class="row">
                <section class="col col-10">
                        <div class="col col-10">
                            Are you sure want to cancel this schedule ?
                        </div>
                </section>
            </div>
        </fieldset>
        
        <footer>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="history_id" value="{{ $scheduleHistoryId }}">
            <button type="submit" class="btn btn-primary">
                Yes
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                No
            </button>
        </footer>

    </form>

</div>
