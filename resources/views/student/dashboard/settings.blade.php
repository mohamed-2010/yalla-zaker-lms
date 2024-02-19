@extends('student.dashboard.layouts.main')

@section('body')

<div class="col-lg-9">
    <!-- Start Instructor Profile  -->
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
        <div class="content">

            <div class="section-title">
                <h4 class="rbt-title-style-3">الاعدادات</h4>
            </div>

            <div class="advance-tab-button mb--30">
                <ul class="nav nav-tabs tab-button-style-2 justify-content-start" id="settinsTab-4" role="tablist">
                    <li role="presentation">
                        <a href="#" class="tab-button active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="true">
                            <span class="title">الحساب</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#" class="tab-button" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" role="tab" aria-controls="password" aria-selected="false">
                            <span class="title">كلمة السر</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="rbt-dashboard-content-wrapper">
                        <div class="tutor-bg-photo bg_image bg_image--23 height-245" style="background-image: url({{ auth()->user()->getFirstMedia('students_cover') != null ? auth()->user()->getFirstMedia('students_cover')->getUrl() : 'assets/images/team/avatar-2.jpg' }})"></div>
                        <!-- Start Tutor Information  -->
                        <div class="rbt-tutor-information">
                            <div class="rbt-tutor-information-left">
                                <div class="thumbnail rbt-avatars size-lg position-relative">
                                    <img src="{{ auth()->user()->getFirstMedia('students') != null ? auth()->user()->getFirstMedia('students')->getUrl() : 'assets/images/team/avatar-2.jpg' }}" alt="Instructor">
                                    <div class="rbt-edit-photo-inner">
                                        <button class="rbt-edit-photo" title="Upload Photo" onclick="pickImage('icon')">
                                            <i class="feather-camera"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="rbt-tutor-information-right">
                                <div class="tutor-btn">
                                    <a class="rbt-btn btn-sm btn-border color-white radius-round-10" onclick="pickImage('cover')" href="javascript:void(0);">Edit Cover Photo</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Tutor Information  -->
                    </div>
                    <!-- Start Profile Row  -->
                    <form action="{{ route('student.dashboard.account.update') }}" class="rbt-profile-row rbt-default-form row row--15" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" hidden id="cover" name="cover">
                        <input type="file" hidden id="icon" name="icon">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="rbt-form-group">
                                <label for="firstname">الاسم</label>
                                <input id="firstname" type="text" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="rbt-form-group">
                                <label for="lastname">البريد الالكتروني</label>
                                <input id="lastname" type="text" value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="rbt-form-group">
                                <label for="username">رقم الهاتف</label>
                                <input id="username" type="text" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="rbt-form-group">
                                <label for="phonenumber">رقم هاتف ولي الامر</label>
                                <input id="phonenumber" type="tel" value="{{ auth()->user()->parent_phone }}">
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="rbt-form-group">
                                <label for="skill">Skill/Occupation</label>
                                <input id="skill" type="text" value="Full Stack Developer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="filter-select rbt-modern-select">
                                <label for="displayname" class="">Display name publicly as</label>
                                <select id="displayname" class="w-100">
                                    <option>Emily Hannah</option>
                                    <option>John</option>
                                    <option>Due</option>
                                    <option>Due John</option>
                                    <option>johndue</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-12 mt--20">
                            <div class="rbt-form-group">
                                <button type="submit" class="rbt-btn btn-gradient">Update Info</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Profile Row  -->
                </div>

                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <!-- Start Profile Row  -->
                    <form action="#" class="rbt-profile-row rbt-default-form row row--15">
                        <div class="col-12">
                            <div class="rbt-form-group">
                                <label for="currentpassword">Current Password</label>
                                <input id="currentpassword" type="password" placeholder="Current Password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="rbt-form-group">
                                <label for="newpassword">New Password</label>
                                <input id="newpassword" type="password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="rbt-form-group">
                                <label for="retypenewpassword">Re-type New Password</label>
                                <input id="retypenewpassword" type="password" placeholder="Re-type New Password">
                            </div>
                        </div>
                        <div class="col-12 mt--10">
                            <div class="rbt-form-group">
                                <a class="rbt-btn btn-gradient" href="#">Update Password</a>
                            </div>
                        </div>
                    </form>
                    <!-- End Profile Row  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Instructor Profile  -->

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Event listener for the icon upload button
        $('.rbt-edit-photo').on('click', function() {
            pickImage('icon');
        });

        // Event listener for the cover photo upload button
        $('.tutor-btn a').on('click', function(e) {
            e.preventDefault(); // Prevent the default anchor action
            pickImage('cover');
        });

        // Define the pickImage function
        window.pickImage = function(target) {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';

            input.onchange = function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Assuming you have elements to display the chosen images.
                    // Adjust selectors according to your HTML.
                    if (target === 'icon') {
                        $('.rbt-avatars img').attr('src', e.target.result);
                    } else if (target === 'cover') {
                        $('.tutor-bg-photo').css('background-image', 'url(' + e.target.result + ')');
                    }
                };
                reader.readAsDataURL(file);
            };

            input.click();
        };
    });
</script>
@endsection