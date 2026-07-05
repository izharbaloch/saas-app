<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .08);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 30px;
        }

        .table-card {
            border: none;
            border-radius: 15px;
        }

        .table th {
            background: #f8f9fa;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 20px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    School Dashboard
                </h2>

                <p class="text-muted">
                    Welcome back! Here's an overview of your schools.
                </p>
            </div>

            <button class="btn btn-primary px-4">
                <i class="bi bi-plus-circle"></i>
                Add School
            </button>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cards -->
        <div class="row g-4">

            <div class="col-lg-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">Total Schools</small>
                            <h2 class="fw-bold mt-2">25</h2>
                            <span class="text-success">Registered</span>
                        </div>

                        <div class="icon-box bg-primary-subtle text-primary">
                            <i class="bi bi-building"></i>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">Active Schools</small>
                            <h2 class="fw-bold mt-2">21</h2>
                            <span class="text-success">Online</span>
                        </div>

                        <div class="icon-box bg-success-subtle text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">Inactive</small>
                            <h2 class="fw-bold mt-2">4</h2>
                            <span class="text-danger">Disabled</span>
                        </div>

                        <div class="icon-box bg-danger-subtle text-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">New This Month</small>
                            <h2 class="fw-bold mt-2">6</h2>
                            <span class="text-primary">Recently Added</span>
                        </div>

                        <div class="icon-box bg-warning-subtle text-warning">
                            <i class="bi bi-stars"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Table -->
        <div class="card table-card shadow-sm mt-5">

            <div class="card-header bg-white py-3 d-flex justify-content-between">

                <h5 class="fw-bold mb-0">
                    Recent Schools
                </h5>

                <input class="form-control w-25" placeholder="Search school...">

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>School Name</th>
                            <th>Sub Domain</th>
                            <th>Domain</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="140">Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($schools as $school)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $school->name }}</td>

                                <td>{{ $school->subdomain }}</td>

                                <td>{{ $school->domain ? $school->domain : '-' }}</td>

                                @if ($school->is_active)
                                    <td>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge bg-danger">
                                            in active
                                        </span>
                                    </td>
                                @endif

                                <td>12 Jul 2026</td>

                                <td>

                                    <button class="btn btn-light btn-action">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <button class="btn btn-warning btn-action">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-action">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>
