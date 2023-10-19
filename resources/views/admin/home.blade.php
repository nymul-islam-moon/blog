@extends('layouts.admin')

@section('admin_content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Good Morning, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} !</h4>
                                        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <form action="javascript:void(0);">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-sm-auto">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                        <div class="input-group-text bg-primary border-primary text-white">
                                                            <i class="ri-calendar-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                                </div>
                                                <!--end col-->
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div><!-- end card header -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k </h4>
                                                <a href="#" class="text-decoration-underline">View net earnings</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success rounded fs-3">
                                                    <i class="bx bx-dollar-circle text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-danger fs-14 mb-0">
                                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                                <a href="#" class="text-decoration-underline">View all orders</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
                                                <a href="#" class="text-decoration-underline">See details</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                                    <i class="bx bx-user-circle text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> My Balance</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-muted fs-14 mb-0">
                                                    +0.00 %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k </h4>
                                                <a href="#" class="text-decoration-underline">Withdraw money</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                                    <i class="bx bx-wallet text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div> <!-- end row-->

                        <div class="row">
                            <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fw-semibold text-uppercase fs-12">Sort by:
                                                    </span><span class="text-muted">Today<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Today</a>
                                                    <a class="dropdown-item" href="#">Yesterday</a>
                                                    <a class="dropdown-item" href="#">Last 7 Days</a>
                                                    <a class="dropdown-item" href="#">Last 30 Days</a>
                                                    <a class="dropdown-item" href="#">This Month</a>
                                                    <a class="dropdown-item" href="#">Last Month</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/products/img-1.png') }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Branded T-Shirts</a></h5>
                                                                    <span class="text-muted">24 Apr 2021</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$29.00</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">62</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">510</h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$1,798</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/products/img-2.png') }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Bentwood Chair</a></h5>
                                                                    <span class="text-muted">19 Mar 2021</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$85.20</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">35</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal"><span class="badge badge-soft-danger">Out of stock</span> </h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$2982</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/products/img-3.png') }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Borosil Paper Cup</a></h5>
                                                                    <span class="text-muted">01 Mar 2021</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$14.00</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">80</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">749</h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$1120</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/products/img-4.png') }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">One Seater Sofa</a></h5>
                                                                    <span class="text-muted">11 Feb 2021</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$127.50</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">56</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal"><span class="badge badge-soft-danger">Out of stock</span></h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$7140</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/products/img-5.png') }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Stillbird Helmet</a></h5>
                                                                    <span class="text-muted">17 Jan 2021</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$54</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">74</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">805</h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">$3996</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                            <div class="col-sm">
                                                <div class="text-muted">
                                                    Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                                </div>
                                            </div>
                                            <div class="col-sm-auto  mt-3 mt-sm-0">
                                                <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a href="#" class="page-link">←</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="#" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">→</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/companies/img-1.png') }}" alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1 fw-medium">
                                                                        <a href="apps-ecommerce-seller-details.html" class="text-reset">iTest Factory</a>
                                                                    </h5>
                                                                    <span class="text-muted">Oliver Tyler</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">Bags and Wallets</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">8547</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">$541200</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 mb-0">32%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                                        </td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/companies/img-2.png') }}" alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="fs-14 my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Digitech Galaxy</a></h5>
                                                                    <span class="text-muted">John Roberts</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">Watches</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">895</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">$75030</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 mb-0">79%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                                        </td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/companies/img-3.png') }}" alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div class="flex-gow-1">
                                                                    <h5 class="fs-14 my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Nesta Technologies</a></h5>
                                                                    <span class="text-muted">Harley Fuller</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">Bike Accessories</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">3470</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">$45600</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 mb-0">90%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                                        </td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/companies/img-8.png') }}" alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="fs-14 my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Zoetic Fashion</a></h5>
                                                                    <span class="text-muted">James Bowen</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">Clothes</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">5488</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">$29456</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 mb-0">40%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                                        </td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('dashboard/assets/images/companies/img-5.png') }}" alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="fs-14 my-1 fw-medium">
                                                                        <a href="apps-ecommerce-seller-details.html" class="text-reset">Meta4Systems</a>
                                                                    </h5>
                                                                    <span class="text-muted">Zoe Dennis</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">Furniture</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">4100</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">$11260</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 mb-0">57%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                                        </td>
                                                    </tr><!-- end -->
                                                </tbody>
                                            </table><!-- end table -->
                                        </div>

                                        <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                            <div class="col-sm">
                                                <div class="text-muted">
                                                    Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                                </div>
                                            </div>
                                            <div class="col-sm-auto  mt-3 mt-sm-0">
                                                <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a href="#" class="page-link">←</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="#" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">→</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div> <!-- .card-body-->
                                </div> <!-- .card-->
                            </div> <!-- .col-->
                        </div> <!-- end row-->



                    </div> <!-- end .h-100-->

                </div> <!-- end col -->


            </div>

        </div>
        <!-- container-fluid -->
    </div>
</div>
<!-- end main content-->
@endsection
