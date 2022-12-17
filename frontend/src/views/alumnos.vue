<template>
	<Layout>
		<template v-slot:component-view>
			<div class="row mt-4 slot-alumnos">
				<div class="card">
					<div class="card-body p-3">
						<h5 class="font-weight-bolder">Alumnos</h5>

						<div class="row col-md-12">
							<div class="text-center">
								<button
									type="button"
									class="btn btn-primary btn-icon-split"
									@click="Nuevo()"
								>
									<vue-feather type="plus"></vue-feather>
									<span class="text">Nuevo</span>
								</button>
							</div>
						</div>
						<div class="col-md-12">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Acciones</th>
										<th>#</th>
										<th>DNI</th>
										<th>Nombres</th>
										<th>Apellido paterno</th>
										<th>Apellido materno</th>
										<th>Edad</th>
										<th>Género</th>
										<th>Estado matrícula</th>
									</tr>
								</thead>
								<tbody>
									<tr
										class="table-bordered"
										v-for="(item, index) in alumnos"
										:key="index"
									>
										<td>
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-warning">
													Editar
												</button>
												<button type="button" class="btn btn-warning">
													Eliminar
												</button>
											</div>
										</td>
										<td align="center">{{ index + 1 }}</td>
										<td align="center">{{ item.dni }}</td>
										<td>{{ item.apellido_paterno }}</td>
										<td>{{ item.apellido_materno }}</td>
										<td>{{ item.nombres }}</td>
										<td align="center">{{ item.edad }}</td>
										<td align="center">{{ item.genero }}</td>
										<td align="center">{{ item.estado_matricula }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div
				class="modal fade"
				id="mdlDatosAlumno"
				role="dialog"
				aria-hidden="true"
				data-bs-backdrop="false"
			>
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mdlDatosAlumno">DATOS DEL ALUMNO</h5>
							<button
								type="button"
								class="btn-close"
								data-bs-dismiss="modal"
								aria-label="Close"
							></button>
						</div>
						<div class="modal-body">
							<div class="row col-md-12">
								<div class="form-group col-md-4">
									<label>DNI</label>
									<input
										type="number"
										class="form-control"
										v-model="frmDatosAlumno.dni"
									/>
								</div>
								<div class="form-group col-md-8">
									<label>NOMBRES</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.nombres"
									/>
								</div>
								<div class="form-group col-md-6">
									<label>APELLIDO PATERNO</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.apellido_paterno"
									/>
								</div>
								<div class="form-group col-md-6">
									<label>APELLIDO MATERNO</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.apellido_materno"
									/>
								</div>
								<div class="form-group col-md-3">
									<label>EDAD</label>
									<input
										type="number"
										class="form-control"
										v-model.number="frmDatosAlumno.edad"
									/>
								</div>
								<div class="form-group col-md-4">
									<label>GÉNERO</label>
									<select class="form-select" v-model="frmDatosAlumno.genero">
										<option :value="0" selected disabled>Seleccione...</option>
										<option value="M">MASCULINO</option>
										<option value="F">FEMENINO</option>
										<option value="O">OTROS</option>
									</select>
								</div>
								<div class="form-group col-md-5">
									<label>ESTADO MATRÍCULA</label>
									<select
										class="form-select"
										v-model="frmDatosAlumno.estado_matricula"
									>
										<option :value="0" selected disabled>Seleccione...</option>
										<option value="REGULAR">REGULAR</option>
										<option value="BECADO">BECADO</option>
										<option value="REPITENTE">REPITENTE</option>
									</select>
								</div>

								<div class="form-group col-md-12">
									<label>EMAIL</label>
									<input
										type="text"
										class="form-control"
										v-model="frmDatosAlumno.email"
									/>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" @click="Guardar">
								Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</template>
	</Layout>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required } from "@vuelidate/validators";

import Layout from "@/components/app-layout.vue";

const noZero = (value) => value != 0;
export default {
	setup() {
		return { v$: useVuelidate() };
	},
	components: {
		Layout,
	},

	data() {
		return {
			api_url: import.meta.env.VITE_API_URL,

			submited: false,

			alumnos: [],

			mdlDatosAlumno: null,

			frmDatosAlumno: {
				modo: "NUEVO",
				id: null,
				apellido_paterno: null,
				apellido_materno: null,
				nombres: null,
				edad: null,
				genero: null,
				estado_matricula: null,
				email: null,
			},
		};
	},

	validations: {
		frmDatosAlumno: {
			apellido_paterno: { required },
			apellido_materno: { required },
			nombres: { required },
			edad: { required },
			genero: { noZero },
			estado_matricula: { noZero },
		},
	},

	mounted() {
		this.mdlDatosAlumno = new bootstrap.Modal(
			document.getElementById("mdlDatosAlumno"),
			{
				keyboard: false,
			}
		);
	},
	methods: {
		Resetear() {
			this.frmDatosAlumno.modo = "NUEVO";
			this.frmDatosAlumno.id = null;
			this.frmDatosAlumno.apellido_paterno = null;
			this.frmDatosAlumno.apellido_materno = null;
			this.frmDatosAlumno.nombres = null;
			this.frmDatosAlumno.edad = null;
			this.frmDatosAlumno.genero = 0;
			this.frmDatosAlumno.estado_matricula = 0;
			this.frmDatosAlumno.email = null;
		},
		Editar() {},
		Nuevo() {
			this.Resetear();
			this.mdlDatosAlumno.show();
		},
		async Guardar() {
			let self = this;
			this.submited = true;

			if (this.v$.frmDatosAlumno.$invalid) {
				this.$swal.fire({
					icon: "error",
					title: "¡Ups!",
					text: "Hay uno o más campos vacíos, verifique.",
				});
				return false;
			}

			let data = new FormData();
			data.append("id", this.frmDatosAlumno.id);
			data.append("dni", this.frmDatosAlumno.dni);

			await axios
				.post(self.api_url + "alumnos/verificar", data)
				.then(function (response) {
					let resultado = response.data;
					if (resultado == "EXISTE") {
						self.$swal.fire({
							icon: "warning",
							title: "¡Ups!",
							text: "Esta información ya está registrada, intente nuevamente.",
						});
						return false;
					} else if (resultado == "NO_EXISTE") {
						self.$swal
							.fire({
								title: "¿Desea continuar?",
								confirmButtonText: "Si",
								showCancelButton: true,
								cancelButtonText: "No",
								allowOutsideClick: false,
								backdrop: true,
							})
							.then((result) => {
								if (result.isConfirmed) {
									self.$swal.fire({
										title: "REGISTRANDO...",
										showConfirmButton: false,
										allowOutsideClick: false,
										willOpen: async () => {
											self.$swal.showLoading();

											let method = null;

											if (self.frmDatosAlumno.modo == "NUEVO") {
												method = axios.post(self.api_url + "alumnos/guardar", {
													frmDatosAlumno: self.frmDatosAlumno,
												});
											} else if (self.frmDatosAlumno.modo == "EDITAR") {
												method = axios.put(
													self.api_url +
														"alumnos/actualizar/" +
														self.frmDatosAlumno.id,
													{
														frmDatosAlumno: self.frmDatosAlumno,
													}
												);
											}

											return await method
												.then((response) => {
													console.log(response);
													self.submited = false;
													// self.ListarRecursos();
													self.mdlDatosAlumno.hide();

													return self.$swal.fire({
														icon: "success",
														title: "¡ÉXITO!",
														timer: 1200,
														showConfirmButton: false,
													});
												})
												.catch((error) => {
													self.$swal.showValidationMessage(
														`Ha ocurrido un error: ${error}`
													);
												});
										},
									});
								}
							});
					}
				});
		},
	},
};
</script>

<style lang="scss">
.mayus {
	text-transform: uppercase;
}
.slot-alumnos {
	width: 70%;
	margin-left: 15%;
}
</style>