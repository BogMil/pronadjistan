<template>
    <full-screen-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kreiraj pretragu
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="md-layout md-gutter">
                    <div
                        class="md-layout-item md-large-size-50 md-medium-size-40 md-small-size-50 md-xsmall-size-100"
                    >
                        <div class="md-layout md-gutter">
                            <div
                                class=" md-layout-item md-large-size-50 md-medium-size-50 md-small-size-100 md-xsmall-size-100"
                            >
                                <md-field>
                                    <label for="tipNekretnine"
                                        >Tip nekretnine</label
                                    >
                                    <md-select
                                        v-model="form.tipNekretnine"
                                        name="tipNekretnine"
                                        id="tipNekretnine"
                                    >
                                        <md-option
                                            v-for="tipNekretnine in tipoviNekretnine"
                                            v-bind:key="tipNekretnine.id"
                                            v-bind:value="tipNekretnine.id"
                                            >{{
                                                tipNekretnine.naziv
                                            }}</md-option
                                        >
                                    </md-select>
                                </md-field>
                            </div>
                            <div
                                class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-100 md-xsmall-size-100"
                            >
                                <md-field>
                                    <label for="grad">Grad</label>
                                    <md-select
                                        v-model="form.grad"
                                        name="grad"
                                        id="grad"
                                        @md-selected="$onGradChange"
                                    >
                                        <md-option
                                            v-for="grad in gradovi"
                                            v-bind:key="grad.id"
                                            v-bind:value="grad.id"
                                            >{{ grad.naziv }}</md-option
                                        >
                                    </md-select>
                                </md-field>
                            </div>

                            <div
                                class=" md-layout-item md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                            >
                                <div>
                                    <md-radio
                                        v-model="form.izdavanjeIliProdaja"
                                        value="izdavanje"
                                        class="md-primary"
                                        >Izdavanje</md-radio
                                    >
                                    <md-radio
                                        v-model="form.izdavanjeIliProdaja"
                                        value="prodaja"
                                        class="md-primary"
                                        >Prodaja</md-radio
                                    >
                                </div>
                            </div>
                            <div
                                class="md-layout-item md-xlarge-size-100 md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                            >
                                <form-group>
                                    <template v-slot:header>
                                        Cena
                                    </template>
                                    <div class="md-layout md-gutter">
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Od (€)</label>
                                                <span class="md-prefix">€</span>
                                                <md-input
                                                    v-model="form.cenaOd"
                                                    type="number"
                                                ></md-input>
                                            </md-field>
                                        </div>
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Do (€)</label>
                                                <span class="md-prefix">€</span>
                                                <md-input
                                                    v-model="form.cenaDo"
                                                    type="number"
                                                ></md-input>
                                            </md-field>
                                        </div>
                                    </div>
                                </form-group>
                            </div>

                            <div
                                class=" md-layout-item md-xlarge-size-100 md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                            >
                                <form-group>
                                    <template v-slot:header>
                                        Kvadratura
                                    </template>
                                    <div class="md-layout md-gutter">
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label
                                                    >Od (m<sup>2</sup>)</label
                                                >
                                                <span class="md-prefix"
                                                    >m<sup>2</sup></span
                                                >
                                                <md-input
                                                    v-model="form.kvadraturaOd"
                                                    type="number"
                                                ></md-input>
                                            </md-field>
                                        </div>
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label
                                                    >Do (m<sup>2</sup>)</label
                                                >
                                                <span class="md-prefix"
                                                    >m<sup>2</sup></span
                                                >
                                                <md-input
                                                    v-model="form.kvadraturaDo"
                                                    type="number"
                                                ></md-input>
                                            </md-field>
                                        </div>
                                    </div>
                                </form-group>
                            </div>

                            <div
                                class=" md-layout-item md-xlarge-size-100 md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                            >
                                <form-group>
                                    <template v-slot:header>
                                        Broj soba
                                    </template>
                                    <div class="md-layout md-gutter">
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Od</label>
                                                <md-select
                                                    v-model="form.brojSobaOd"
                                                >
                                                    <md-option
                                                        v-for="brojSobe in brojeviSoba"
                                                        v-bind:key="brojSobe.id"
                                                        v-bind:value="
                                                            brojSobe.id
                                                        "
                                                        >{{
                                                            brojSobe.naziv
                                                        }}</md-option
                                                    >
                                                </md-select>
                                            </md-field>
                                        </div>
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Do</label>
                                                <md-select
                                                    v-model="form.brojSobaDo"
                                                >
                                                    <md-option
                                                        v-for="brojSobe in brojeviSoba"
                                                        v-bind:key="brojSobe.id"
                                                        v-bind:value="
                                                            brojSobe.id
                                                        "
                                                        >{{
                                                            brojSobe.naziv
                                                        }}</md-option
                                                    >
                                                </md-select>
                                            </md-field>
                                        </div>
                                    </div>
                                </form-group>
                            </div>
                            <div
                                class=" md-layout-item md-xlarge-size-100 md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                            >
                                <form-group>
                                    <template v-slot:header>
                                        Spratnost
                                    </template>
                                    <div class="md-layout md-gutter">
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Od</label>
                                                <md-select
                                                    v-model="form.spratOd"
                                                >
                                                    <md-option
                                                        v-for="sprat in spratovi"
                                                        v-bind:key="sprat.id"
                                                        v-bind:value="sprat.id"
                                                        >{{
                                                            sprat.naziv
                                                        }}</md-option
                                                    >
                                                </md-select>
                                            </md-field>
                                        </div>
                                        <div
                                            class="md-layout-item md-large-size-50 md-medium-size-50 md-small-size-50 md-xsmall-size-50"
                                        >
                                            <md-field>
                                                <label>Do</label>
                                                <md-select
                                                    v-model="form.spratDo"
                                                >
                                                    <md-option
                                                        v-for="sprat in spratovi"
                                                        v-bind:key="sprat.id"
                                                        v-bind:value="sprat.id"
                                                        >{{
                                                            sprat.naziv
                                                        }}</md-option
                                                    >
                                                </md-select>
                                            </md-field>
                                        </div>
                                    </div>
                                </form-group>
                            </div>
                        </div>
                    </div>
                    <div
                        class="md-layout-item  md-large-size-50 md-medium-size-60 md-small-size-50 md-xsmall-size-100"
                    >
                        <div class="md-layout-item">
                            <span class="md-headline">Delovi grada</span>
                            <md-button
                                v-if="form.grad != ''"
                                class="md-icon-button md-raised"
                                @click="showDialog = true"
                            >
                                <md-icon style="color:green">add</md-icon>
                            </md-button>
                            <div v-else style="color:red">
                                * niste odabrali grad
                            </div>
                        </div>
                        <div class="md-layout md-gutter">
                            <div
                                v-for="cekiranaOpstina in form.cekiraneOpstineObj"
                                v-bind:key="cekiranaOpstina.id"
                                class="md-layout-item md-large-size-33 md-medium-size-25 md-small-size-50 md-xsmall-size-100"
                            >
                                <md-card>
                                    <md-card-header>
                                        <div class="md-title">
                                            {{ cekiranaOpstina.naziv }}
                                            <button
                                                style="color:red"
                                                @click="
                                                    () =>
                                                        $deleteOpstina(
                                                            cekiranaOpstina.id
                                                        )
                                                "
                                            >
                                                x
                                            </button>
                                        </div>
                                    </md-card-header>

                                    <md-card-content>
                                        <div
                                            v-for="cekiraniDeoOpstine in cekiranaOpstina.deloviOpstine"
                                            v-bind:key="cekiraniDeoOpstine.id"
                                            class="md-primary"
                                        >
                                            <span
                                                style="border:1px solid green;padding-left:5px;padding-right:5px"
                                            >
                                                {{ cekiraniDeoOpstine.naziv }}
                                                <button
                                                    @click="
                                                        () =>
                                                            $deleteDeoOpstine(
                                                                `${cekiranaOpstina.id}-${cekiraniDeoOpstine.id}`
                                                            )
                                                    "
                                                    style="color:red"
                                                >
                                                    x
                                                </button>
                                            </span>
                                        </div>
                                    </md-card-content>
                                </md-card>
                            </div>
                        </div>
                    </div>
                    <div
                        class="md-layout-item  md-large-size-100 md-medium-size-100 md-small-size-100 md-xsmall-size-100"
                    >
                        <div class="md-layout-item">
                            <md-button
                                v-if="formDataIsValid"
                                class="md-raised md-accent"
                                @click="$onSave"
                            >
                                Sačuvaj
                            </md-button>
                            <md-button
                                v-else
                                class="md-raised md-accent"
                                disabled
                            >
                                Sačuvaj
                            </md-button>
                        </div>
                    </div>
                    <izbor-dela-grada-modal
                        :idGrada="form.grad"
                        :showDialog="showDialog"
                        :cekiraneOpstineProp="cekiraneOpstineId"
                        :cekiraniDeloviOpstineProp="cekiraniDeloviOpstineId"
                        @close="showDialog = false"
                        @setCekiraneLokacije="$setCekiraneLokacije"
                    />
                </div>
            </div>
        </div>
    </full-screen-layout>
</template>

<script>
import FullScreenLayout from "./../../Layouts/FullScreenLayout";
import JetSectionBorder from "./../../Jetstream/SectionBorder";
import JetButton from "./../../Jetstream/Button";
import IzborDelaGradaModal from "./IzborDelaGradaModal";
import FormGroup from "../../Components/FormGroup";

export default {
    props: ["sessions"],

    components: {
        FullScreenLayout,
        JetSectionBorder,
        JetButton,
        IzborDelaGradaModal,
        FormGroup
    },
    data() {
        return {
            form: this.$inertia.form({
                grad: "",
                tipNekretnine: "",
                izdavanjeIliProdaja: "izdavanje",
                cenaOd: "",
                cenaDo: "",
                kvadraturaOd: "",
                kvadraturaDo: "",
                brojSobaDo: "",
                brojSobaOd: "",
                spratOd: "",
                spratDo: "",
                cekiraneOpstineObj: []
            }),
            gradovi: [],
            showDialog: false,
            tipoviNekretnine: [],
            brojeviSoba: [],
            spratovi: []
        };
    },
    computed: {
        cekiraneOpstineId() {
            return this.form.cekiraneOpstineObj.map(x => x.id);
        },
        cekiraniDeloviOpstineId() {
            return this.form.cekiraneOpstineObj
                .map(x => x.deloviOpstine.map(d => `${x.id}-${d.id}`))
                .flat();
        },
        formDataIsValid() {
            return (
                this.form.grad != "" &&
                this.form.tipNekretnine != "" &&
                this.form.tipNekretnine != "" &&
                this.form.cekiraneOpstineObj.length != 0
            );
        }
    },
    methods: {
        $onGradChange(event) {
            this.form.cekiraneOpstineObj = [];
        },
        $setCekiraneLokacije(cekiraneOpstineObj) {
            this.form.cekiraneOpstineObj = cekiraneOpstineObj;
        },
        $deleteOpstina(cekiranaOpstinaId) {
            this.form.cekiraneOpstineObj = this.form.cekiraneOpstineObj.filter(
                x => x.id != cekiranaOpstinaId
            );
        },
        $deleteDeoOpstine(deoOpstineComplexId) {
            let [idOpstine, idDelaOpstine] = deoOpstineComplexId.split("-");

            let _cekiraneOpstineObj = this.form.cekiraneOpstineObj.map(x => {
                x.deloviOpstine = x.deloviOpstine.filter(
                    d => d.id != idDelaOpstine
                );
                return x;
            });
            this.form.cekiraneOpstineObj = _cekiraneOpstineObj.filter(
                x => x.deloviOpstine.length > 0
            );
        },
        $onSave() {
            console.log(this.form);
            axios.post("/api/univerzalnaPretraga", this.form);
        },
        getData() {
            return {};
        }
    },
    mounted() {
        axios
            .get("/api/gradovi")
            .then(response => (this.gradovi = response.data));

        this.tipoviNekretnine = [
            { id: 1, naziv: "stan" },
            { id: 2, naziv: "kuca" }
        ];

        this.brojeviSoba = [
            { id: "", naziv: "---" },
            { id: 1, naziv: "0.5" },
            { id: 2, naziv: "1" },
            { id: 3, naziv: "1.5" },
            { id: 4, naziv: "2" },
            { id: 5, naziv: "2.5" },
            { id: 6, naziv: "3" },
            { id: 7, naziv: "3.5" },
            { id: 8, naziv: "4" },
            { id: 9, naziv: "4+" }
        ];

        this.spratovi = [
            { id: "", naziv: "---" },
            { id: 1, naziv: "SUT" },
            { id: 2, naziv: "PSUT" },
            { id: 3, naziv: "PR" },
            { id: 4, naziv: "VPR" },
            { id: 5, naziv: "1" },
            { id: 6, naziv: "2" },
            { id: 7, naziv: "3" },
            { id: 8, naziv: "4" },
            { id: 9, naziv: "5" },
            { id: 10, naziv: "10" }
        ];
    }
};
</script>
