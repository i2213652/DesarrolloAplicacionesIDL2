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
							<table
								class="table table-hover"
								id="tblAlumnos"
								width="100% important"
							>
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
										<td align="center">
											<div class="btn-group text-center" role="group">
												<button
													type="button"
													class="btn btn-warning"
													@click="Editar(item)"
												>
													<vue-feather type="edit"></vue-feather>
												</button>
												<button
													type="button"
													class="btn btn-danger"
													@click="Eliminar(item.id)"
												>
													<vue-feather type="trash"></vue-feather>
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
										min="1"
										maxlength="8"
										name="dni"
										@keyup="Validar"
										:class="[
											submited
												? v$.frmDatosAlumno.dni.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
										v-model="frmDatosAlumno.dni"
									/>
								</div>
								<div class="form-group col-md-8">
									<label>NOMBRES</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.nombres"
										:class="[
											submited
												? v$.frmDatosAlumno.nombres.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
									/>
								</div>
								<div class="form-group col-md-6">
									<label>APELLIDO PATERNO</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.apellido_paterno"
										:class="[
											submited
												? v$.frmDatosAlumno.apellido_paterno.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
									/>
								</div>
								<div class="form-group col-md-6">
									<label>APELLIDO MATERNO</label>
									<input
										type="text"
										class="form-control mayus"
										v-model="frmDatosAlumno.apellido_materno"
										:class="[
											submited
												? v$.frmDatosAlumno.apellido_materno.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
									/>
								</div>
								<div class="form-group col-md-3">
									<label>EDAD</label>
									<input
										type="number"
										class="form-control"
										min="1"
										maxLength="2"
										name="edad"
										@keyup="Validar"
										:class="[
											submited
												? v$.frmDatosAlumno.edad.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
										v-model.number="frmDatosAlumno.edad"
									/>
								</div>
								<div class="form-group col-md-4">
									<label>GÉNERO</label>
									<select
										class="form-select"
										v-model="frmDatosAlumno.genero"
										:class="[
											submited
												? v$.frmDatosAlumno.genero.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
									>
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
										:class="[
											submited
												? v$.frmDatosAlumno.estado_matricula.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
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
										:class="[
											submited
												? v$.frmDatosAlumno.email.$invalid
													? 'is-invalid'
													: 'is-valid'
												: '',
										]"
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

import "~/jquery/dist/jquery";
import "~/datatables.net-dt/js/dataTables.dataTables";
import "~/datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

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
				dni: null,
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
			dni: { required },
			apellido_paterno: { required },
			apellido_materno: { required },
			nombres: { required },
			edad: { required },
			genero: { noZero },
			estado_matricula: { noZero },
			email: { required },
		},
	},
	watch: {
		alumnos() {
			$("#tblAlumnos").DataTable().destroy();
			this.TablaAlumnos();
		},
	},
	mounted() {
		this.Listar();
		this.TablaAlumnos();
		this.mdlDatosAlumno = new bootstrap.Modal(
			document.getElementById("mdlDatosAlumno"),
			{
				keyboard: false,
			}
		);
	},
	methods: {
		Validar(e) {
			let name = e.target.name;
			let maxlength = e.target.maxLength;
			let value = e.target.value;

			if (value.length > maxlength) {
				value = value.slice(0, maxlength);
				if (name == "dni") {
					this.frmDatosAlumno.dni = value;
				} else if (name == "edad") {
					this.frmDatosAlumno.edad = value;
				}
			}
		},
		TablaAlumnos() {
			this.$nextTick(() => {
				let table = $("#tblAlumnos").DataTable({
					scrollY: "350px",
					scrollX: true,
					scrollCollapse: true,
					paging: false,
					ordering: false,
					info: true,
					lengthChange: false,
					language: {
						retrieve: true,
						emptyTable: "No hay datos disponibles en la tabla",
						info: "Mostrando del _START_ al _END_ de _TOTAL_ registros",
						infoEmpty: "No se encontraron registros",
						infoFiltered: "(filtrado de _MAX_ registros)",
						thousands: ",",
						paginate: {
							first: "Primera",
							last: "Ultima",
							next: '<i class="fas fa-chevron-circle-right" style="font-size:20px;"></i>',
							previous:
								'<i class="fas fa-chevron-circle-left" style="font-size:20px;"></i>',
						},
					},
				});
			});
		},
		async Listar() {
			let self = this;
			return await axios
				.get(this.api_url + "alumnos/listar")
				.then(function (response) {
					self.alumnos = response.data;
				});
		},
		Resetear() {
			this.frmDatosAlumno.modo = "NUEVO";
			this.frmDatosAlumno.id = null;
			this.frmDatosAlumno.dni = null;
			this.frmDatosAlumno.apellido_paterno = null;
			this.frmDatosAlumno.apellido_materno = null;
			this.frmDatosAlumno.nombres = null;
			this.frmDatosAlumno.edad = null;
			this.frmDatosAlumno.genero = 0;
			this.frmDatosAlumno.estado_matricula = 0;
			this.frmDatosAlumno.email = null;
		},
		Nuevo() {
			this.Resetear();
			this.mdlDatosAlumno.show();
		},
		Editar(item) {
			this.frmDatosAlumno.modo = "EDITAR";
			this.frmDatosAlumno.id = item.id;
			this.frmDatosAlumno.dni = item.dni;
			this.frmDatosAlumno.apellido_paterno = item.apellido_paterno;
			this.frmDatosAlumno.apellido_materno = item.apellido_materno;
			this.frmDatosAlumno.nombres = item.nombres;
			this.frmDatosAlumno.edad = item.edad;
			this.frmDatosAlumno.genero = item.genero;
			this.frmDatosAlumno.estado_matricula = item.estado_matricula;
			this.frmDatosAlumno.email = item.email;
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
													self.submited = false;
													self.Listar();
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
		Eliminar(alumno_id) {
			let self = this;
			this.$swal
				.fire({
					title: "¿Desea elimar el registro?",
					confirmButtonText: "Si",
					showCancelButton: true,
					cancelButtonText: "No",
					allowOutsideClick: false,
					backdrop: true,
				})
				.then((result) => {
					if (result.isConfirmed) {
						self.$swal.fire({
							title: "ELIMINANDO...",
							showConfirmButton: false,
							allowOutsideClick: false,
							willOpen: async () => {
								self.$swal.showLoading();

								return await axios
									.delete(self.api_url + "alumnos/eliminar/" + alumno_id)
									.then((response) => {
										self.Listar();
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
		},
	},
};
</script>

<style lang="scss">
@import "datatables.net-dt";

.mayus {
	text-transform: uppercase;
}
.slot-alumnos {
	width: 100%;
}
</style>