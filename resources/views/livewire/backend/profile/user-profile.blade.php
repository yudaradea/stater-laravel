<section>
    <div class="page-header card">
        <div class="row align-items-center card-body">
            <div class="col-auto">
                <span class="avatar avatar-lg" style="background-image: url({{ $user->picture }})"></span>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="page-title">{{ $user->name }}</h2>
                <div class="page-subtitle">
                    <div class="row">
                        <div class="col-auto">
                            <a href="#" class="text-reset">{{ '@' . $user->username }} |
                                {{ $user->authorType->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 col-md-auto mt-md-0 mt-4">
                <input type="file" name="file" id="ChangeUserPictureFile" class="d-none"
                    onchange="this.dispatchEvent(new InputEvent('input'))">
                <a href="#" class="btn btn-primary"
                    onclick="event.preventDefault();document.getElementById('ChangeUserPictureFile').click();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-edit"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 8h.01"></path>
                        <path d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4"></path>
                        <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3"></path>
                        <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596"></path>
                        <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
                    </svg>
                    Change Picture
                </a>
            </div>
        </div>
    </div>
</section>

