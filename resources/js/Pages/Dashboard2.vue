<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard 2
            </h2>
        </template>
        <Toast />
        <Toast position="top-left" group="tl" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gray-800 border-b border-gray-200">
                        <Toolbar class="p-mb-4">
                            <template #left>
                                <Button :disabled="multipleTerima" label="Terima" icon="pi pi-thumbs-up"
                                    class="p-button-primary p-mr-2" @click="submitmultipleTerima" />
                                    <!-- <Button :disabled="multipleTerima" label="Tolak" icon="pi pi-thumbs-up"
                                    class="p-button-danger p-mr-2" @click="submitmultipleTerima" /> -->
                                    <Button  label="Back Step" icon="pi pi-arrow-left"
                                    class="p-button-danger p-mr-2" @click="submitMultipleBack" />
                                <!-- <Button :disabled="multipleGudang" label="Gudang Akhir" icon="pi pi-home"
                                    class="p-button-success p-mr-2" @click="submitmultipleGudang" /> -->
                                <!-- <Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedProducts || !selectedProducts.length" /> -->
                            </template>

                            <template #right>
                                <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import" chooseLabel="Import" class="p-mr-2 p-d-inline-block" />
                    <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)"  /> -->
                            </template>
                        </Toolbar>
                        <!-- {{selectedDokumens}} -->
                        <DataTable :value="dokumens" v-model:selection="selectedDokumens" stripedRows
                            responsiveLayout="scroll" :paginator="true" :rows="10"
                            paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                            :rowsPerPageOptions="[10,20,50]"
                            currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                            :resizableColumns="true" columnResizeMode="expand" showGridlines :filters="filters">
                            <template #header>
                                <div class="table-header p-d-flex p-flex-column p-flex-md-row p-jc-md-between">
                                    <h5 class="p-mb-2 p-m-md-0 p-as-md-center">Manage Dokumen</h5>
                                    <span>

                                    </span>

                                    <span class="p-input-icon-left">

                                        <i class="pi pi-search" />
                                        <InputText v-model="filters['global'].value" placeholder="Search..." />
                                    </span>
                                </div>
                            </template>
                            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                            <Column field="id" header="ID" :sortable="true"></Column>
                            <Column field="kodeAdmin" header="Kode Administrasi" :sortable="true"></Column>
                            <Column field="jumlahSetHitung" header="Jumlah Set Dihitung" :sortable="true"></Column>
                            <Column field="status" header="Status" :sortable="true">

                                <template #body="slotProps">
                                    <!-- {{slotProps.data}} -->
                    

                                    <Button label="Gudang" v-if="slotProps.data.status == 'Gudang'" icon="pi pi-book" class="p-button-sm p-button-rounded" style="background-color: #b3e5fc; color: #23547b; font-weight: 700;font-size: 12px;letter-spacing: .3px;"  /> 
                                    <Button label="Guillotine" v-if="slotProps.data.status == 'Guillotine'" icon="pi pi-inbox" class="p-button-sm p-button-rounded" style="background-color: #FEEDAF; color: #8A5340;font-weight: 700;font-size: 12px;letter-spacing: .3px;"  /> 
                                    <Button label="Kirim IPDS" v-if="slotProps.data.status == 'Kirim IPDS'" icon="pi pi-envelope" class="p-button-sm p-button-rounded" style="background-color: #ECCFFF; color: #694382;font-weight: 700;font-size: 12px;letter-spacing: .3px;"  /> 
                                    <Button label="Diterima IPDS" v-if="slotProps.data.status == 'Diterima IPDS'" icon="pi pi-thumbs-up" class="p-button-sm p-button-rounded" style="background-color:  #FFD8B2; color: #805B36;font-weight: 700;font-size: 12px;letter-spacing: .3px;"  />
                                    <Button label="Gudang Akhir" v-if="slotProps.data.status == 'Gudang Akhir'" icon="pi pi-home" class="p-button-sm p-button-rounded" style="background-color: #C8E6C9; color: #256029;font-weight: 700;font-size: 12px;letter-spacing: .3px;"  />
                                </template>

                            </Column>

                            <Column field="petugas" header="Petugas" :sortable="true"></Column>
                            <Column field="updated_at_custom" header="Tanggal" :sortable="true"></Column>
                            <Column field="nosurat_string" header="No Surat" :sortable="true">
                                <template #body="slotProps">
                                    {{slotProps.data.nosurat_string}}

                                </template>
                            </Column>
                            <Column :exportable="false" header="Aksi">
                                <template #body="slotProps">
                                    <Button label="Guillotine" v-if="slotProps.data.status ==  'Gudang'"
                                        @click="guillotineDialog(slotProps.data)" icon="pi pi-check" iconPos="right" />
                                    <Button class="p-button-success" v-if="slotProps.data.status ==  'Guillotine'"
                                        label="Kirim IPDS" @click="guillotineDialog(slotProps.data)"
                                        icon="pi pi-send" />
                                    <Button class="p-button-primary" v-if="slotProps.data.status ==  'Kirim IPDS'"
                                        label="Selesai" icon="pi pi-check" />

                                    <!-- <Button icon="pi pi-trash" class="p-button-rounded p-button-danger"
                            @click="deleteCustomerDialog(slotProps.data)" /> -->

                                </template>
                            </Column>
                        </DataTable>
                        <ConfirmDialog></ConfirmDialog>

                        <br><br>


                        <!-- <button @click="download">Tes PDF</button> -->


                    </div>
                </div>
            </div>
        </div>

            <div class="p-grid p-jc-center" v-if="multipleGudang == false">
            <div class="p-col-2">

            </div>
            <div class="p-col-8">
                <!-- <Button class="p-button-success" label="Download PDF" @click="download" icon="pi pi-download" /> -->
                <Button :disabled="multipleGudang" label="Gudang Akhir" icon="pi pi-home"
                                    class="p-button-success p-mr-2" @click="download" />
                <!-- <h1>Surat Pengantar</h1> -->
                <br><br>


                <div id="surat" ref="suratpengantar" class="text-black bg-gray-200"
                    style="font-size: 12px; width: 793px;">

                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="p-grid p-jc-between">
                            <div class="p-col-3">
                                <img src="..\..\Picture1.png" alt="" class="w-96 h-14" srcset="">
                            </div>
                            <div class="p-col-6">

                            </div>
                            <div class="p-col-3">

                            </div>
                        </div>
                        <br><br>
                        <p>
                            <table style="width:300px">
                                <tr>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>: {{this.nosuratString}}</td>
                                </tr>
                                <tr>
                                    <td>Sifat</td>
                                    <td>: Biasa</td>
                                </tr>
                                <tr>
                                    <td>Lampiran</td>
                                    <td>: -</td>
                                </tr>
                                <tr>
                                    <td>Hal</td>
                                    <td>: Surat Pengantar</td>
                                </tr>
                            </table>
                        </p>
                        <br><br>

                        <p>Yth. Penanggung Jawab Gudang BPS Provinsi Sulawesi Tengah <br>
                            Di – <br>
                            Tempat</p>
                        <br><br>
                        <p> &nbsp;&nbsp; Berikut kami kirimkan daftar dokumen c1 yang telah di guillotine</p>
                        <br>

                        <table style="width: 500px; border: 1px solid black;">
                            <tr style="border: 1px solid black;">
                                <th style="border: 1px solid black;">Kode Administrasi</th>
                                <th style="border: 1px solid black;">Jumlah Set Hitung</th>
                                <th style="border: 1px solid black;">Petugas</th>
                                <th style="border: 1px solid black;">Tanggal</th>

                            </tr>
                            <tr style="border: 1px solid black;" v-for="item in this.selectedDokumens">
                                <td style="border: 1px solid black;">{{item.kodeAdmin}}</td>
                                <td style="border: 1px solid black;">{{item.jumlahSetHitung}}</td>
                                <td style="border: 1px solid black;">{{item.petugas}}</td>
                                <td style="border: 1px solid black;">{{item.updated_at_custom}}</td>
                            </tr>

                        </table>



                        <br>
                        <p>
                            &nbsp; &nbsp; Demikian disampaikan untuk diperhatikan. Terima Kasih.
                        </p>
                        <br>
                        <br><br>
                        <br>
                        <div class="p-grid p-jc-between">
                            <div class="p-col-4">
                                <!-- <p>
                                    Penerima
                                </p>
                                <br><br><br><br>
                                <p>
                                    ...............
                                </p> -->
                            </div>
                            <div class="p-col-4">

                            </div>
                            <div class="p-col-4">
                                <p>
                                   Palu, {{this.datenow}} <br>
                                    Penanggung Jawab
                                </p>
                                <br><br><br><br>
                                <p>
                                    {{$page.props.auth.user.name }}
                                </p>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
            <div class="p-col-2">

            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import {
        FilterMatchMode
    } from 'primevue/api';
    // import VueHtml2pdf from 'vue-html2pdf'
    import {
        jsPDF
    } from "jspdf";
    import html2canvas from 'html2canvas';
    import domtoimage from 'dom-to-image';
    export default {
        components: {
            BreezeAuthenticatedLayout,
            // VueHtml2pdf
        },

        props: {
            auth: Object,
            errors: Object,
            dokumens: Object,
            nosuratString: String,
            datenow: String,
            currentIndex: Number
        },
        data() {
            return {
                suratView: false,
                filters: {},
                selectedDokumens: null,
                multipleTerima: true,
                multipleGudang: true,
            }
        },
        created() {

            this.initFilters();
        },
        watch: {
            // whenever question changes, this function will run
            selectedDokumens: function (newSelected, oldSelected) {
                console.log(oldSelected, 'oldSelected');
                if (newSelected.length == 0) {
                    this.multipleTerima = true
                    this.multipleGudang = true
                } else {
                    var r = []
                    var r2 = []
                    console.log('newSelected', newSelected)
                    newSelected.forEach(element => {
                        console.log(element.status)
                        if (element.status == 'Kirim IPDS') {
                            r.push(false)

                        } else {
                            r.push(true)
                        }

                        if (element.status == 'Diterima IPDS') {
                            r2.push(false)

                        } else {
                            r2.push(true)
                        }
                    });
                    if (r.includes(true)) {
                        this.multipleTerima = true
                    } else {
                        this.multipleTerima = false
                    }
                    if (r2.includes(true)) {
                        this.multipleGudang = true
                    } else {
                        this.multipleGudang = false
                    }
                    r2 = null
                    newSelected = null
                    console.log(r2, 'r2')
                    console.log(this.multipleGudang, 'multipleIPDS')

                }

            }
        },
        methods: {
             async download() {
                
                var htmlDiv = document.getElementById('surat');
                const scale = 1;
                console.log(scale);
                //   let userEmail = this.userEmail;
               await domtoimage.toPng(htmlDiv,
                    {
                        height: htmlDiv.offsetHeight * scale,
                        width: htmlDiv.offsetWidth * scale,
                        style: {
                            transform: "scale(" + scale + ")",
                            transformOrigin: "top left",
                            width: htmlDiv.offsetWidth + "px",
                            height: htmlDiv.offsetHeight + "px"
                        }
                    }
                ).then((dataUrl) => {
                    var htmlImage = new Image();
                    htmlImage.src = dataUrl;
                    var pdf = new jsPDF('p', 'mm', 'a4');
                    // pdf.setFontStyle("Bold");

                    // pdf.text(325, 40);
                    pdf.addImage(htmlImage, 'JPEG', 0, 0);
                    pdf.save(this.nosuratString + '.pdf');
                }).catch((error) => {
                    console.error('Error: ', error);
                });

                await this.$inertia.post('/submitmultiplegudang', [this.selectedDokumens, this
                            .nosuratString, this.currentIndex
                        ], {
                            onStart: () => {
                                this.sending = true
                            },
                            onProgress: (progressEvent) => {
                                //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                                this.progressBar = parseInt(Math.round((progressEvent.loaded *
                                        100) /
                                    progressEvent.total))
                                console.log(progressEvent.loaded)
                                console.log('Upload Progress: ', this.progressBar)
                            },

                            onSuccess: (response) => {
                                // Handle success event
                                console.log('onSuccess', response)
                                // this.$toast.add({severity:'success', summary: 'Yeay, Berhasil', detail:'Pesan Berhasil Dikirim', life: 3000});

                                this.sending = false
                                this.selectedDokumens = []

                            },
                            onError: (errors) => {
                                // Handle validation errors
                                console.log('onError', errors)

                                this.sending = false

                            },
                            onFinish: () => {

                                this.sending = false
                               
                            }
                        })
                        this.$toast.add({
                            severity: 'info',
                            summary: 'Confirmed',
                            detail: ' Berhasil di Gudang',
                            life: 3000
                        });
             },
            //      generateReport () {
            //     this.$refs.html2Pdf.generatePdf()
            // },
            // async download() {
                
            //     var htmlDiv = document.getElementById('surat');
            //     const scale = 1;
            //     console.log(scale);
            //     //   let userEmail = this.userEmail;
            //    await domtoimage.toPng(htmlDiv,
            //         {
            //             height: htmlDiv.offsetHeight * scale,
            //             width: htmlDiv.offsetWidth * scale,
            //             style: {
            //                 transform: "scale(" + scale + ")",
            //                 transformOrigin: "top left",
            //                 width: htmlDiv.offsetWidth + "px",
            //                 height: htmlDiv.offsetHeight + "px"
            //             }
            //         }
            //     ).then((dataUrl) => {
            //         var htmlImage = new Image();
            //         htmlImage.src = dataUrl;
            //         var pdf = new jsPDF('p', 'mm', 'a4');
            //         // pdf.setFontStyle("Bold");

            //         // pdf.text(325, 40);
            //         pdf.addImage(htmlImage, 'JPEG', 0, 0);
            //         pdf.save(this.nosuratString + '.pdf');
            //     }).catch((error) => {
            //         console.error('Error: ', error);
            //     });

            //     await this.$inertia.post('/submitmultipleGudang', [this.selectedDokumens, this
            //                 .nosuratString, this.currentIndex
            //             ], {
            //                 onStart: () => {
            //                     this.sending = true
            //                 },
            //                 onProgress: (progressEvent) => {
            //                     //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
            //                     this.progressBar = parseInt(Math.round((progressEvent.loaded *
            //                             100) /
            //                         progressEvent.total))
            //                     console.log(progressEvent.loaded)
            //                     console.log('Upload Progress: ', this.progressBar)
            //                 },

            //                 onSuccess: (response) => {
            //                     // Handle success event
            //                     console.log('onSuccess', response)
            //                     this.$toast.add({
            //                         severity: 'success',
            //                         summary: 'Yeay, Berhasil',
            //                         detail: 'Data Berhasil Dikirim',
            //                         life: 3000
            //                     });
            //                     // this.download()
            //                     this.sending = false
            //                     this.selectedDokumens = []



            //                 },
            //                 onError: (errors) => {
            //                     // Handle validation errors
            //                     console.log('onError', errors)
            //                     this.$toast.add({
            //                         severity: 'success',
            //                         summary: 'ERROR!!!',
            //                         detail: 'ERROR!!!',
            //                         life: 3000
            //                     });
            //                     this.sending = false

            //                 },
            //                 onFinish: () => {

            //                     this.sending = false
            //                     console.log(this.currentIndex, 'currentIndex')
            //                 }
            //             })
            // },
            guillotineDialog(data) {
                // const target_copy = Object.assign({}, this.selectedDokumens);
                // console.log(target_copy[0].id)
                this.$confirm.require({
                    message: 'Apakah yakin akan di guillotine?',
                    header: 'Guillotine Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'p-button-primary',
                    accept: () => {
                        console.log(data.id)
                        this.$inertia.post('/submitguillotine', data, {
                            onStart: () => {
                                this.sending = true
                            },
                            onProgress: (progressEvent) => {
                                //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                                this.progressBar = parseInt(Math.round((progressEvent.loaded *
                                        100) /
                                    progressEvent.total))
                                console.log(progressEvent.loaded)
                                console.log('Upload Progress: ', this.progressBar)
                            },

                            onSuccess: (response) => {
                                // Handle success event
                                console.log('onSuccess', response)
                                // this.$toast.add({severity:'success', summary: 'Yeay, Berhasil', detail:'Pesan Berhasil Dikirim', life: 3000});

                                this.sending = false

                            },
                            onError: (errors) => {
                                // Handle validation errors
                                console.log('onError', errors)

                                this.sending = false

                            },
                            onFinish: () => {

                                this.sending = false

                            }
                        })
                        this.$toast.add({
                            severity: 'info',
                            summary: 'Confirmed',
                            detail: 'Berhasil di Guillotine',
                            life: 3000
                        });
                    },
                    reject: () => {
                        this.$toast.add({
                            severity: 'error',
                            summary: 'Rejected',
                            detail: 'You have rejected',
                            life: 3000
                        });
                    }
                });

            },
            submitmultipleTerima() {
                this.$confirm.require({
                    message: 'Apakah yakin akan diterima semua?',
                    header: 'Multiple Acceptance Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'p-button-primary',
                    accept: () => {

                        this.$inertia.post('/submitmultipleterima', this.selectedDokumens, {
                            onStart: () => {
                                this.sending = true
                            },
                            onProgress: (progressEvent) => {
                                //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                                this.progressBar = parseInt(Math.round((progressEvent.loaded *
                                        100) /
                                    progressEvent.total))
                                console.log(progressEvent.loaded)
                                console.log('Upload Progress: ', this.progressBar)
                            },

                            onSuccess: (response) => {
                                // Handle success event
                                console.log('onSuccess', response)
                                // this.$toast.add({severity:'success', summary: 'Yeay, Berhasil', detail:'Pesan Berhasil Dikirim', life: 3000});

                                this.sending = false
                                this.selectedDokumens = []

                            },
                            onError: (errors) => {
                                // Handle validation errors
                                console.log('onError', errors)

                                this.sending = false

                            },
                            onFinish: () => {

                                this.sending = false

                            }
                        })
                        this.$toast.add({
                            severity: 'info',
                            summary: 'Confirmed',
                            detail: ' Berhasil di Terima',
                            life: 3000
                        });
                    },
                    reject: () => {
                        this.$toast.add({
                            severity: 'error',
                            summary: 'Rejected',
                            detail: 'You have rejected',
                            life: 3000
                        });
                    }
                });

            },
               submitMultipleBack() {
                this.$confirm.require({
                    message: 'Apakah yakin akan di back step semua?',
                    header: 'Multiple Back Step Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'p-button-primary',
                    accept: () => {

                        this.$inertia.post('/submitmultiplebackstep2', this.selectedDokumens, {
                            onStart: () => {
                                this.sending = true
                            },
                            onProgress: (progressEvent) => {
                                //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                                this.progressBar = parseInt(Math.round((progressEvent.loaded *
                                        100) /
                                    progressEvent.total))
                                console.log(progressEvent.loaded)
                                console.log('Upload Progress: ', this.progressBar)
                            },

                            onSuccess: (response) => {
                                // Handle success event
                                console.log('onSuccess', response)
                                // this.$toast.add({severity:'success', summary: 'Yeay, Berhasil', detail:'Pesan Berhasil Dikirim', life: 3000});

                                this.sending = false
                                this.selectedDokumens = []

                            },
                            onError: (errors) => {
                                // Handle validation errors
                                console.log('onError', errors)

                                this.sending = false

                            },
                            onFinish: () => {

                                this.sending = false

                            }
                        })
                        this.$toast.add({
                            severity: 'info',
                            summary: 'Confirmed',
                            detail: ' Berhasil di Guillotine',
                            life: 3000
                        });
                    },
                    reject: () => {
                        this.$toast.add({
                            severity: 'error',
                            summary: 'Rejected',
                            detail: 'You have rejected',
                            life: 3000
                        });
                    }
                });

            },
            submitmultipleGudang() {
                // this.$confirm.require({
                //     message: 'Apakah yakin akan dikirim ke Gudang semua?',
                //     header: 'Multiple Gudang Confirmation',
                //     icon: 'pi pi-info-circle',
                //     acceptClass: 'p-button-primary',
                //     accept: () => {

                        this.$inertia.post('/submitmultiplegudang', [this.selectedDokumens, this
                            .nosuratString, this.currentIndex
                        ], {
                            onStart: () => {
                                this.sending = true
                            },
                            onProgress: (progressEvent) => {
                                //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                                this.progressBar = parseInt(Math.round((progressEvent.loaded *
                                        100) /
                                    progressEvent.total))
                                console.log(progressEvent.loaded)
                                console.log('Upload Progress: ', this.progressBar)
                            },

                            onSuccess: (response) => {
                                // Handle success event
                                console.log('onSuccess', response)
                                // this.$toast.add({severity:'success', summary: 'Yeay, Berhasil', detail:'Pesan Berhasil Dikirim', life: 3000});

                                this.sending = false
                                this.selectedDokumens = []

                            },
                            onError: (errors) => {
                                // Handle validation errors
                                console.log('onError', errors)

                                this.sending = false

                            },
                            onFinish: () => {

                                this.sending = false
                                this.download()
                            }
                        })
                        this.$toast.add({
                            severity: 'info',
                            summary: 'Confirmed',
                            detail: ' Berhasil di Gudang',
                            life: 3000
                        });
                //     },
                //     reject: () => {
                //         this.$toast.add({
                //             severity: 'error',
                //             summary: 'Rejected',
                //             detail: 'You have rejected',
                //             life: 3000
                //         });
                //     }
                // });

            },
            

            initFilters() {
                this.filters = {
                    'global': {
                        value: null,
                        matchMode: FilterMatchMode.CONTAINS
                    },
                }
            }
        },
    }

</script>
