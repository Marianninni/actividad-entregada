@extends('admin.app')

@section('content')
    <div class="app-title">
        <div>

        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
               <ul class="nav flex-column nav-tabs user-tabs">
    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
    <li class="nav-item"><a class="nav-link" href="#values" data-toggle="tab">Message Values</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
               
                    <div class="tile">
                        <form action="{{ route('admin.faq.update') }}" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">Message Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="code">Name</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Write the matter of this message"
                                            id="code"
                                            name="code"
                                            value="{{ old('name', $message->name) }}"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="code">Subject</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="Write the matter of this message"
                                        id="code"
                                        name="code"
                                        value="{{ old('subject', $message->subject) }}"
                                    />
                                </div>
                                <input type="hidden" name="id" value="{{ $message->id }}">
                                <div class="form-group">
                                    <label class="control-label" for="name">Message</label>
                                    <textarea 
                                      class="form-control"
                                        type="area"
                                        placeholder="Your message"
                                        id="name"
                                        name="name"
                                        value="{{ old('message', $message->message) }}"
                                    >
                                      
                                    </textarea>
                                </div>
                               
                                
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Message</button>
                                        <a class="btn btn-danger" href="{{ route('admin.faq.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('backend/js/app.js') }}"></script>
@endpush

@endsection