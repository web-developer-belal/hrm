<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | SmartHR - Advanced Bootstrap 5 Multipurpose Admin Dashboard Template for HRM, Payroll & CRM</title>
	
	<meta name="description" content="SmartHR - An advanced Bootstrap 5 admin dashboard template for HRM and CRM. Ideal for managing employee records, payroll, attendance, recruitment, and team performance with an intuitive and responsive design. Perfect for HR teams and business managers looking to streamline workforce management.">
	<meta name="keywords" content="HR dashboard template, HRM admin template, Bootstrap 5 HR dashboard, workforce management dashboard, employee management system, payroll dashboard, HR analytics, admin dashboard, CRM admin template, human resources management, HR admin template, team management dashboard, recruitment dashboard, employee attendance system, performance management, HR CRM, HR dashboard HTML, Bootstrap HR template, employee engagement, HR software, project management dashboard">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">

    @include('partials.css')
    @stack('css')
</head>

<body class="antialiased bg-light text-default">

	<div id="global-loader">
		<div class="page-loader"></div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		@include('partials.header')

		@include('partials.sidebar')

		

		<!-- Page Wrapper -->
		<div class="page-wrapper relative pt-[50px] ml-[252px]">
			<div class="content p-6 pb-0">

				@yield('content')
				{{ $slot ??'' }}
			</div>

			@include('partials.footer')

		</div>
		<!-- /Page Wrapper -->		

		<!-- Add Leaves -->
		<div id="add_leaves" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4">
			<div class="relative p-4 w-full max-w-[500px] max-h-full">
				<div class="relative bg-white rounded-defaultradius">
					<div class="flex items-center justify-between p-4 border-b border-borderColor">
						<h4 class="font-semibold">Add Leaves</h4>
						<button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="add_leaves">
							<i class="ti ti-x"></i>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<form action="index.html">
						<div class="p-4">
							<div id="default-styled-tab-content">
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
									<div class="md:col-span-12">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">Employee Name</label>
										<select class="select">
											<option>Select</option>
											<option>Anthony Lewis</option>
											<option>Brian Villalobos</option>
											<option>Harvey Smith</option>
										</select>
									</div>
									<div class="md:col-span-12">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">Leave Type</label>
										<select class="select">
											<option>Select</option>
											<option>Medical Leave</option>
											<option>Casual Leave</option>
											<option>Annual Leave</option>
										</select>
									</div>
									<div class="md:col-span-6">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">From </label>
										<div class="relative">
											<div class="absolute inset-y-0 end-2 flex items-center pointer-events-none">
												<i class="ti ti-calendar text-gray-600 text-base leading-normal"></i>
											</div>
											<input type="text" class="flatpickr-input flat-datepickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" placeholder="dd/mm/yyyy">
										</div>
									</div>
									<div class="md:col-span-6">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">To </label>
										<div class="relative">
											<div class="absolute inset-y-0 end-2 flex items-center pointer-events-none">
												<i class="ti ti-calendar text-gray-600 text-base leading-normal"></i>
											</div>
											<input type="text" class="flatpickr-input flat-datepickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" placeholder="dd/mm/yyyy">
										</div>
									</div>
									<div class="md:col-span-6">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">No of Days </label>
										<input type="text" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400 disabled:bg-light disabled:text-default" disabled="">
									</div>
									<div class="md:col-span-6">
										<label class="block mb-1 text-sm leading-normal font-medium text-title">Remaining Days </label>
										<input type="text" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" value="8" disabled="">
									</div>
									<div class="md:col-span-12">
										<label for="message" class="block mb-1 text-sm leading-normal font-medium text-title">Reason </label>
										<textarea id="message" rows="3" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="flex items-center justify-end p-4 border-t border-borderColor">
							<button data-modal-hide="add_leaves" type="button" class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 font-medium me-2">Cancel
							</button>
							<button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white font-medium">Add
								Leave
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Leaves -->

		<!-- Add Project -->
		<div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4" id="add_project" role="dialog">
			<div class="relative p-4 w-full max-w-[500px] max-h-full">
				<div class="relative bg-white rounded-defaultradius">
					<div class="flex items-center justify-between p-4 border-b border-borderColor">
						<div class="flex items-center">
							<h5 class="modal-title me-2">Add Project </h5>
							<p class="text-dark">Project ID : PRO-0004</p>
						</div>
						<button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="add_project">
							<i class="ti ti-x"></i>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<div class="add-info-fieldset">
						<div class="add-details-wizard p-3 pb-0">
							<ul class="progress-bar-wizard flex items-center border-b">
								<li class="active p-2 pt-0">
									<h6 class="fw-medium">Basic Information</h6>
								</li>
								<li class="p-2 pt-0">									
									<h6 class="fw-medium">Members</h6>
								</li>
							</ul>
						</div>
						<fieldset id="first-field-file">
							<form action="projects.html">
								<div class="modal-body p-4">
									<div class="grid grid-cols-1 lg:grid-cols-12">
										<div class="col-span-12">
											<div class="flex items-center flex-wrap gap-2 bg-light w-full rounded-defaultradius p-4">                                                
												<div class="flex items-center justify-center size-20 rounded-full border border-dashed shrink-0 text-dark frames">
													<i class="ti ti-photo text-gray-2 fs-16"></i>
												</div>                                              
												<div class="profile-upload">
													<div class="mb-2">
														<h6 class="mb-1">Upload Profile Image</h6>
														<p class="text-xs leading-normal">Image should be below 4 mb</p>
													</div>
													<div class="profile-uploader d-flex items-center">
														<div class="drag-upload-btn btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white text-xs leading-normal relative py-1 px-2 me-2">
															Upload
															<input type="file" class="w-full h-full absolute top-0 left-0 opacity-0" multiple="">
														</div>
														<a href="javascript:void(0);" class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 text-xs leading-normal py-1 px-2">Cancel</a>
													</div>													
												</div>
											</div>
										</div>
										<div class="col-span-12">
											<div class="mb-3">
												<label class="form-label">Project Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-span-12">
											<div class="mb-3">
												<label class="form-label">Client</label>
												<select class="select">
													<option>Select</option>
													<option>Anthony Lewis</option>
													<option>Brian Villalobos</option>
												</select>
											</div>
										</div>
										<div class="col-span-12">
											<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6">
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">Start Date</label>
														<div class="relative">
															<div class="absolute inset-y-0 end-2 flex items-center pointer-events-none">
																<i class="ti ti-calendar text-gray-600 text-base leading-normal"></i>
															</div>
															<input type="text" class="flatpickr-input flat-datepickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" placeholder="dd/mm/yyyy">
														</div>
													</div>
												</div>
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">End Date</label>
														<div class="relative">
															<div class="absolute inset-y-0 end-2 flex items-center pointer-events-none">
																<i class="ti ti-calendar text-gray-600 text-base leading-normal"></i>
															</div>
															<input type="text" class="flatpickr-input flat-datepickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" placeholder="dd/mm/yyyy">
														</div>
													</div>
												</div>
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">Priority</label>
														<select class="select">
															<option>Select</option>
															<option>High</option>
															<option>Medium</option>
															<option>Low</option>
														</select>
													</div>
												</div>
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">Project Value</label>
														<input type="text" class="form-control" value="$">
													</div>
												</div>
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">Total Working Hours</label>
														<div class="relative">
															<div class="absolute inset-y-0 end-2 flex items-center pointer-events-none">
																<i class="ti ti-clock text-gray-600 text-base leading-normal"></i>
															</div>
															<input type="text" class="flatpickr-input flat-timepickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400" placeholder="dd/mm/yyyy">
														</div>
													</div>
												</div>
												<div class="col-span-6">
													<div class="mb-3">
														<label class="form-label">Extra Time</label>
														<input type="text" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="col-span-12">
											<div class="mb-0">
												<label class="form-label">Description</label>
												<div class="summernote"></div>
											</div>
										</div>
									</div>								
								</div>
								<div class="modal-footer p-4 border-t">
									<div class="flex items-center justify-end">
										<button type="button" class="btn btn-outline-light border me-2" data-modal-hide="add_project">Cancel</button>
										<button class="btn btn-primary wizard-next-btn" type="button">Add Team Member</button>
									</div>
								</div>
							</form>
						</fieldset>
						<fieldset>
							<form action="projects.html">
								<div class="modal-body p-4">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label me-2">Team Members</label>
												<input class="input-tags form-control" placeholder="Add new" type="text" data-role="tagsinput" name="Label" value="Jerald,Andrew,Philip,Davis">
											</div>
										</div>
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label me-2">Team Leader</label>
												<input class="input-tags form-control" placeholder="Add new" type="text" data-role="tagsinput" name="Label" value="Hendry,James">
											</div>
										</div>
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label me-2">Project Manager</label>
												<input class="input-tags form-control" placeholder="Add new" type="text" data-role="tagsinput" name="Label" value="Dwight">
											</div>
										</div>
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label">Status</label>
												<select class="select">
													<option>Select</option>
													<option>Active</option>
													<option>Inactive</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div>
												<label class="form-label">Tags</label>
												<select class="select">
													<option>Select</option>
													<option>High</option>
													<option>Low</option>
													<option>Medium</option>
												</select>
											</div>
										</div>
									</div>								
								</div>
								<div class="modal-footer p-4 border-t">
									<div class="flex items-center justify-end">
										<button type="button" class="btn btn-outline-light border me-2" data-modal-hide="add_project">Cancel</button>
										<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#success_modal">Save</button>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Project -->

		<!-- Add Todo -->
		<div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4" id="add_todo">
			<div class="relative p-4 w-full max-w-[500px] max-h-full">
				<div class="relative bg-white rounded-defaultradius">
					<div class="flex items-center justify-between p-4 border-b border-borderColor">
						<h4 class="modal-title">Add New Todo</h4>
						<button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="add_todo">
							<i class="ti ti-x"></i>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<form action="index.html">
						<div class="modal-body p-4">
							<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6">
								<div class="col-span-12">
									<div class="mb-3">
										<label class="form-label">Todo Title</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-span-6">
									<div class="mb-3">
										<label class="form-label">Tag</label>
										<select class="select">
											<option>Select</option>
											<option>Internal</option>
											<option>Projects</option>
											<option>Meetings</option>
											<option>Reminder</option> 	 
										</select>
									</div>
								</div>
								<div class="col-span-6">
									<div class="mb-3">
										<label class="form-label">Priority</label>
										<select class="select">
											<option>Select</option>
											<option>Medium</option>
											<option>High</option>
											<option>Low</option>
										</select>
									</div>
								</div>
								<div class="col-span-12">
									<div class="mb-3">
										<label class="form-label">Descriptions</label>
										<div class="summernote"></div>
									</div>
								</div>
								<div class="col-span-12">
									<div class="mb-3">
										<label class="form-label">Add Assignee</label>
										<select class="select">
											<option>Select</option>
											<option>Sophie</option>
											<option>Cameron</option>
											<option>Doris</option>
											<option>Rufana</option>
										</select>
									</div>
								</div>
								<div class="col-span-12">
									<div class="mb-0">
										<label class="form-label">Status</label>
										<select class="select">
											<option>Select</option>
											<option>Completed</option>
											<option>Pending</option>
											<option>Onhold</option>
											<option>Inprogress</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer flex items-center justify-end p-4 border-t">
							<button type="button" class="btn btn-light me-2" data-modal-hide="add_todo">Cancel</button>
							<button type="submit" class="btn btn-primary">Add New Todo</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Todo -->

	</div>
	<!-- /Main Wrapper -->

	@include('partials.js')
    @stack('scripts')
</body>

</html>