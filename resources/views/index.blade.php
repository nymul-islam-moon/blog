<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <section style="background-color: #eee;">
        <div class="container my-5 py-5">

            @foreach ($blogs as $blog)
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach



          {{-- <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-start align-items-center">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                      height="60" />
                    <div>
                      <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                      <p class="text-muted small mb-0">
                        Shared publicly - Jan 2020
                      </p>
                    </div>
                  </div>

                  <p class="mt-3 mb-4 pb-2">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                  </p>

                  <div class="small d-flex justify-content-start">
                    <a href="#!" class="d-flex align-items-center me-3">
                      <i class="far fa-thumbs-up me-2"></i>
                      <p class="mb-0">Like</p>
                    </a>
                    <a href="#!" class="d-flex align-items-center me-3">
                      <i class="far fa-comment-dots me-2"></i>
                      <p class="mb-0">Comment</p>
                    </a>
                    <a href="#!" class="d-flex align-items-center me-3">
                      <i class="fas fa-share me-2"></i>
                      <p class="mb-0">Share</p>
                    </a>
                  </div>
                </div>
                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                  <div class="d-flex flex-start w-100">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                      height="40" />
                    <div class="form-outline w-100">
                      <textarea class="form-control" id="textAreaExample" rows="4"
                        style="background: #fff;"></textarea>
                      <label class="form-label" for="textAreaExample">Message</label>
                    </div>
                  </div>
                  <div class="float-end mt-2 pt-1">
                    <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
