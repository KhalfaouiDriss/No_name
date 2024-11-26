<style>
    h1 {
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: bold;
        color: #343a40;
    }

    label {
        font-weight: 500;
        margin-bottom: 5px;
        display: inline-block;
    }

    .btn-send {
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        width: 100%;
        padding: 10px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #f8f9fa;
    }

    .card-header {
        background-color: #343a40;
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 15px;
        font-weight: bold;
        font-size: 1.25rem;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        font-size: 0.9rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .text-center h1 {
        font-size: 1.75rem;
        font-weight: bold;
        color: #495057;
    }

    .text-muted {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i> Contact Form Example
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="text-center mt-4">
                            <h1>Bootstrap Contact Form</h1>
                            <p class="text-muted">Please fill out the form below to get in touch with us.</p>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card mt-4 p-4">
                                    <div class="card-body">
                                        <form id="contact-form" role="form">
                                            <div class="row mb-3">

                                                <div class="col-md-6">
                                                    <label for="form_name">First Name *</label>
                                                    <input id="form_name" type="text" name="name" class="form-control"
                                                        placeholder="Enter your first name" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="form_lastname">Last Name *</label>
                                                    <input id="form_lastname" type="text" name="surname" class="form-control"
                                                        placeholder="Enter your last name" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                .col-
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_message">Message *</label>
                                                <textarea id="form_message" name="message" class="form-control"
                                                    placeholder="Write your message here" rows="5" required></textarea>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success btn-send">Send Message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
