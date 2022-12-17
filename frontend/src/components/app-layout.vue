<template>
	<body class="g-sidenav-show bg-gray-100">
		<aside
			class="
				sidenav
				navbar navbar-vertical navbar-expand-xs
				border-0 border-radius-xl
				my-3
				fixed-start
				ms-3
			"
			id="sidenav-main"
		>
			<div class="sidenav-header">
				<router-link class="navbar-brand m-0" to="/">
					<img
						src="@/assets/img/logo-ct-dark.png"
						class="navbar-brand-img h-100"
						alt="main_logo"
					/>
					<span class="ms-1 font-weight-bold">Registro de alumnos</span>
				</router-link>
			</div>
			<hr class="horizontal dark mt-0" />
			<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="../pages/dashboard.html">
							<div
								class="
									icon icon-shape icon-sm
									shadow
									border-radius-md
									bg-white
									text-center
									me-2
									d-flex
									align-items-center
									justify-content-center
								"
							>
								<vue-feather type="users"></vue-feather>
							</div>
							<span class="nav-link-text ms-1">Alumnos</span>
						</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="../pages/tables.html">
							<div
								class="
									icon icon-shape icon-sm
									shadow
									border-radius-md
									bg-white
									text-center
									me-2
									d-flex
									align-items-center
									justify-content-center
								"
							>
							<vue-feather type="users"></vue-feather>
							</div>
							<span class="nav-link-text ms-1">Tables</span>
						</a>
					</li> -->
				</ul>
			</div>
		</aside>
		<main
			class="
				main-content
				position-relative
				max-height-vh-100
				h-100
				border-radius-lg
			"
		>
			<!-- Navbar -->
			<nav
				class="
					navbar navbar-main navbar-expand-lg
					px-0
					mx-4
					shadow-none
					border-radius-xl
				"
				id="navbarBlur"
				navbar-scroll="true"
			>
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol
							class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
						>
							<li class="breadcrumb-item text-sm">
								<a class="opacity-5 text-dark" href="javascript:;">Home</a>
							</li>
							<li
								class="breadcrumb-item text-sm text-dark active"
								aria-current="page"
							>
								Alumnos
							</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">Alumnos</h6>
					</nav>
				</div>
			</nav>
			<div class="container-fluid py-4">
				<slot name="component-view"></slot>
			</div>
		</main>
	</body>
</template>

<script>
export default {};
</script>

<style>
body {
	position: fixed;
	padding: 0;
	margin: 0;

	top: 0;
	left: 0;

	width: 100%;
	height: 100%;
}

.vue-feather {
	width: 13px;
	height: 13px;
}
</style>