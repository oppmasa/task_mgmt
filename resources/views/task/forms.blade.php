                    <form class="forms-sample" id="submit_form" action="{{$action}}" method="post">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ユーザー名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" disabled value="{{$user_name}}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="title" class="col-sm-3 col-form-label">タイトル<span class="text-danger">※</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="タイトル" value="@if(old('title')){{old('title')}}@elseif(!empty($task)){{$task->title}}@endif">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="contents" class="col-sm-3 col-form-label">内容</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('contents') is-invalid @enderror" id="contents" name="contents" placeholder="内容" rows="4" cols="40">@if(old('contents')){{old('contents')}}@elseif(!empty($task)){{$task->contents}}@endif</textarea>
                                @error('contents')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="deadline" class="col-sm-3 col-form-label">期限</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="@if(old('deadline')){{old('deadline')}}@elseif(!empty($task)){{$task->deadline}}@endif">
                                @error('deadline')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </form>


