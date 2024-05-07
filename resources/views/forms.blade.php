@extends('layouts.master')
@section('title')
    Зворотній зв'язок
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="Моніторинг світла" title=" Зворотній зв'язок" />
@endsection
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-md-flex gap-3 text-center">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-0">Форма зворотнього зв'язку</h4>
                                            <p class="text-muted mb-0">Сюди можна надсилати свої питання по роботі сайту чи свої рекомендації</p>
                                        </div>
                                        <div class="flex-shrink-0 mt-3 mt-md-0">
                                            <div class="nav nav-pills code-menu bg-light p-1 rounded" role="tablist">
                                           </div>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="inputExamplePreview" role="tabpanel" aria-labelledby="inputExamplePreview-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <form  action="/forms" method="post" >
                                                        @csrf

                                                        <div>
                                                            <label for="basiInput" class="form-label pt-3">Тема чи Ім'я</label>
                                                            <input type="text" class="form-control" name="name" id="basiInput">
                                                        </div>

                                                        <div>
                                                            <label for="iconInput"  class="form-label pt-3">Свою пошту</label>
                                                            <div class="form-icon">
                                                                <input type="email" name="email" class="form-control form-control-icon" id="iconInput"
                                                                       @auth
                                                                           value="{{@Auth::user()->email}}"
                                                                       @endauth
                                                                       placeholder="example@gmail.com">
                                                                <i class="ri-mail-unread-line"></i>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label for="exampleFormControlTextarea5" class="form-label pt-3">Текст повідомлення</label>
                                                            <textarea class="form-control" name="message"  id="exampleFormControlTextarea5" rows="5"></textarea>
                                                        </div>
                                                        <div class="pt-3">
                                                            <button type="submit" class="btn btn-primary ">Надіслати</button>
                                                        </div>

                                                    </form>



                                            </div>
                                                <div class="col-md-3">
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->



@endsection
@section('scripts')

        <!-- prismjs plugin -->
        <script src="{{ URL::asset('/build/libs/prismjs/prism.js') }}"></script>
<!-- App js -->
<script src="{{ URL::asset('/build/js/app.js') }}"></script>
@endsection
