<div class="row p-2">
    <div class="col-12 col-lg-8 p-2">
        <div class="card x-card position-relative" style="min-height: 70vh;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center">
                        <span class="h5 text-primary m-0 me-2">SOAL NO</span>
                        <span id="soal-num-head"
                            class="d-inline-block bg-primary text-white rounded-circle text-center fw-bold"
                            style="width: 35px; height: 35px; line-height: 35px;"></span>
                    </div>
                    <div class="mt-4">
                        <p class="fw-bold" id="soal-value"></p>
                        <div id="answers"></div>
                    </div>
                </div>
                <div class="form-inline d-flex justify-content-between">
                    <button type="button" class="btn btn-primary text-white">Sebelumnya</button>
                    <label for="check-ragu-ragu" class="btn btn-warning text-white d-flex align-items-center"
                        role="button">
                        <input type="checkbox" class="form-check-input x-check m-0" id="check-ragu-ragu">
                        <span class="ms-2">Ragu-ragu</span>
                    </label>
                    <button type="button" class="btn btn-primary text-white">Selanjutnya</button>
                </div>
            </div>

            <div class="w-100 h-100 position-absolute d-none"
                style="border-radius: inherit; background-color: rgba(0, 0, 0, 0.5);" data-x-loading>
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 p-2">
        <div class="card x-card">
            <div class="card-body px-4">
                <span class="h5 text-primary">Navigasi Soal</span>
                <div class="mb-4"></div>
                <div class="row" id="soal-nav">
                    <!-- loop soal -->
                    <div class="col-3 p-2">
                        <div class="w-100">
                            <button type="button" class="btn btn-secondary w-100">001</button>
                        </div>
                    </div>
                    <!-- loop soal end -->
                </div>
            </div>
        </div>
    </div>
</div>
