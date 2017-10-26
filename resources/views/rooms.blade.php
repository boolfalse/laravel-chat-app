@extends('layouts.app')

@section('content')

    {{--<div class="container">--}}
        {{--<div class="form-group pull-right">--}}
            {{--<button id="room_search" type="button" class="btn btn-info btn-lg"><i class="fa fa-search"></i></button>--}}
        {{--</div>--}}
        {{--<div class="form-group pull-left">--}}
            {{--<button id="create_room" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addRoom">Create room</button>--}}
        {{--</div>--}}
        {{--<div id="system_message" class="pull-left"></div>--}}
        {{--<div class="clearfix"></div>--}}
    {{--</div>--}}




    @if(count($rooms) > 0)
        <div id="load_rooms" class="mmmsearch-content">
            @include('load_rooms')
        </div>
    @endif






    {{--<div class="modal fade" id="addRoom" role="dialog">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}

                {{--<form id="upload_form" class="form-horizontal" method="POST" action="{{ route('addRoom') }}"  enctype="multipart/form-data" role="form">--}}

                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">Form Submitting with AJAX (file upload)</h4>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="form-horizontal">--}}

                            {{--<div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="first_name" class="col-md-4 control-label">First Name *</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter First Name" autofocus>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="last_name" class="col-md-4 control-label">Last Name *</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="email" class="col-md-4 control-label">File Upload *</label>--}}
                                {{--<input id="upload_file" type="file" name="file" required="required" class="col-md-4">--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="email" class="col-md-4 control-label">room Tags *</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<textarea id="tags" name="tags"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-cancel"></i> Cancel</button>--}}
                        {{--<button id="add_room" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>--}}
                    {{--</div>--}}

                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}" />--}}
                {{--</form>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    {{--<script type="text/javascript">--}}
        {{--// HELPER ACTIONS--}}
        {{--// THROWN WARNINGS ON room ADDING--}}
        {{--function printErrorMsg (msg) {--}}
            {{--$(".print-error-msg").find("ul").html('');--}}
            {{--$(".print-error-msg").css('display','block');--}}
            {{--$.each( msg, function( key, value ) {--}}
                {{--$(".print-error-msg").find("ul").append('<li>'+value+'</li>');--}}
            {{--});--}}
        {{--}--}}
        {{--// SYNCHRONIZATION AFTER ADDING ROOM--}}
        {{--function getrooms(url) {--}}
            {{--$.ajax({--}}
                {{--url: url,--}}
                {{--data: {--}}
                    {{--'paginate': true--}}
                {{--}--}}
            {{--}).done(function (data){--}}
                {{--$('#load_rooms').html(data);--}}
            {{--}).fail(function () {--}}
                {{--alert("rooms couldn\'t be loaded!");--}}
            {{--});--}}
        {{--}--}}
        {{--// EMPTY ALL NECESSARY INPUTS ON MODAL CLOSE--}}
        {{--$('#addRoom').on('hidden.bs.modal', function () {--}}
            {{--$("#first_name, #last_name, #tags, #upload_file").val('');--}}

            {{--// Remove all tags--}}
{{--//            var tags = $('#tags').tagEditor('getTags')[0].tags;--}}
{{--//            for (var i=0; i<tags.length; i++){--}}
{{--//                $('#tags').tagEditor('removeTag', tags[i]);--}}
{{--//            }--}}
            {{--$('#tags').tagEditor('destroy');--}}
        {{--});--}}
        {{--// GO TO roomS LIST SIMPLE (INITIAL) STATE ON MODAL OPEN--}}
        {{--$('#addRoom').on('shown.bs.modal', function () {--}}
            {{--initTagEditor('tags');--}}
            {{--$.ajax({--}}
                {{--async: true,--}}
                {{--type: "GET",--}}
                {{--url: document.location.origin,--}}
                {{--data: {--}}
                    {{--'paginate': true--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('#load_rooms').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}


        {{--// DOCUMENT READY--}}
        {{--$(document).ready(function ()--}}
        {{--{--}}
            {{--// TAG EDITORS INITIALIZATIONS--}}
            {{--//ss https://goodies.pixabay.com/jquery/tag-editor/demo.html--}}
            {{--initTagEditor('search_tags');--}}

            {{--// room ADDING ACTION--}}
            {{--$("#add_room").click(function(){--}}
                {{--var options = {--}}
                    {{--complete: function(response) {--}}
                        {{--if($.isEmptyObject(response.responseJSON.error)){--}}
                            {{--$('#addRoom').modal('hide');--}}

                            {{--// Synchronous request--}}
                            {{--// document.location.replace(document.location.href);--}}

                            {{--// ASynchronous request--}}
                            {{--//ss https://stackoverflow.com/questions/4309587/page-auto-reload-without-refresh--}}
                            {{--$.ajax({--}}
                                {{--async: true,--}}
                                {{--type: "GET",--}}
                                {{--url: document.location.href,--}}
                                {{--data: {--}}
                                    {{--'paginate': true--}}
                                {{--},--}}
                                {{--success: function (data) {--}}
                                    {{--// console.log(data);--}}
                                    {{--$('#load_rooms').html(data);--}}

                                    {{--// show notification about success and hide it--}}
                                    {{--$('#system_message').html('<div class="alert alert-success"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> room successfully added with uploaded file.</div>');--}}
                                    {{--setTimeout(--}}
                                        {{--function() {--}}
                                            {{--$('#system_message').slideUp(function () {--}}
                                                {{--$(this).empty();--}}
                                            {{--});--}}
                                        {{--}--}}
                                    {{--, 3000);--}}

                                    {{--//ss TODO: Later can refresh "window.autocompleteSource" tagEditor autocomplete source (for simple list pagination, also for search list)--}}
                                {{--}--}}
                            {{--});--}}
                        {{--}else{--}}
                            {{--printErrorMsg(response.responseJSON.error);--}}
                        {{--}--}}
                    {{--}--}}
                {{--};--}}
                {{--$("#upload_form").ajaxForm(options);--}}
            {{--});--}}

            {{--// PAGINATION ACTION--}}
            {{--//ss https://laraget.com/blog/how-to-create-an-ajax-pagination-using-laravel--}}
            {{--$('body').on('click', '.pagination a', function(e) {--}}
                {{--e.preventDefault();--}}

                {{--// here styling just not most important thing, that's why I just kept this for normally UI--}}
                {{--$('#load a').css('color', '#dfecf6');--}}
                {{--$('#load').append("<img style='position: absolute; top: 20%; left: 40%; z-index: 10;' src='{{asset("img/loading_spinner.gif")}}' />");--}}

                {{--var url = $(this).attr('href');--}}
                {{--getrooms(url);--}}
                {{--window.history.pushState("", "", url);--}}
            {{--});--}}

            {{--// SEARCH ACTION ON PRESSING BUTTON--}}
            {{--$('#room_search').click(function () {--}}
                {{--var search_fn = $('#search_first_name').val();--}}
                {{--var search_ln = $('#search_last_name').val();--}}
                {{--var search_tags = $('#search_tags').tagEditor('getTags')[0].tags;--}}
                {{--if((search_fn.length + search_ln.length + search_tags.length) > 0)--}}
                {{--{--}}
                    {{--// here styling just not most important thing, that's why I just kept this for normally UI--}}
                    {{--$('#load a').css('color', '#dfecf6');--}}
                    {{--$('#load').append("<img style='position: absolute; top: 20%; left: 40%; z-index: 10;' src='{{asset("img/loading_spinner.gif")}}' />");--}}

                    {{--$.ajax({--}}
                        {{--url: "{{ route('rooms') }}",--}}
                        {{--data: {--}}
                            {{--'paginate': false,--}}
                            {{--'search_fn': search_fn,--}}
                            {{--'search_ln': search_ln,--}}
                            {{--'search_tags': search_tags,--}}
                            {{--'_token': "{{ csrf_token() }}"--}}
                        {{--},--}}
                        {{--type: "POST",--}}
                        {{--success: function (response) {--}}
                            {{--console.log(response);--}}
                            {{--$('#load_rooms').html(response);--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}

        {{--});--}}
    {{--</script>--}}




@endsection
