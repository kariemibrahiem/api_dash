<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('users.store')}}">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="photo" class="form-control-label">{{ trns('image') }}</label>
                    <input type="file" accept="image/*" class="form-control" name="photo" id="photo">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{  trns('user_name')}}</label>
                    <input type="text" class="form-control" name="username" id="user_name">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="email" class="form-control-label">{{ trns('email') }}</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="form-control-label">{{ trns('phone') }}</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ trns('password') }}</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ trns('password_confirmation') }}</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password">
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trns('close') }}</button>
            <button type="submit" class="btn btn-primary" id="addButton">{{ trns('save') }}</button>
        </div>

    </form>
</div>



<script>
    $('.dropify').dropify();
</script>
