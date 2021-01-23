<template>
    <div class=" sm:flex sm:items-center sm:ml-6">
        <div>
            <md-dialog
                :md-active.sync="showDialog"
                :md-backdrop="false"
                @md-opened="$onModalOpen"
                @md-closed="$onModalClose"
            >
                <md-dialog-title style="margin-bottom:0"
                    >Izaberi deo grada</md-dialog-title
                >
                <div v-if="this.isLoading" style="padding:20px">
                    UČITAVANJE...
                </div>
                <div v-else style="overflow-y:auto">
                    <div v-for="opstina in opstine" v-bind:key="opstina.id">
                        <md-card>
                            <md-card-expand>
                                <md-card-actions
                                    md-alignment="space-between"
                                    style="padding-top:0;padding-bottom:0"
                                >
                                    <md-checkbox
                                        v-model="cekiraneOpstine"
                                        :value="opstina.id"
                                        @change="
                                            () => {
                                                $afterCheckOpstina(opstina.id);
                                            }
                                        "
                                    ></md-checkbox>
                                    {{ opstina.naziv }}
                                    <md-card-expand-trigger>
                                        <md-button class="md-icon-button">
                                            <md-icon
                                                >keyboard_arrow_down</md-icon
                                            >
                                        </md-button>
                                    </md-card-expand-trigger>
                                </md-card-actions>

                                <md-card-expand-content>
                                    <md-card-content style="padding-top:0">
                                        <div
                                            v-for="deoOpstine in opstina.deloviOpstine"
                                            v-bind:key="deoOpstine.id"
                                            style="background-color:#e2eded;padding-left:5px"
                                        >
                                            <md-checkbox
                                                v-model="cekiraniDeloviOpstine"
                                                :value="
                                                    `${opstina.id}-${deoOpstine.id}`
                                                "
                                                @change="
                                                    () => {
                                                        $afterCheckDeoOpstine(
                                                            `${opstina.id}-${deoOpstine.id}`
                                                        );
                                                    }
                                                "
                                                >{{
                                                    deoOpstine.naziv
                                                }}</md-checkbox
                                            >
                                        </div>
                                    </md-card-content>
                                </md-card-expand-content>
                            </md-card-expand>
                        </md-card>
                    </div>
                </div>

                <md-dialog-actions>
                    <md-button
                        class="md-primary"
                        @click="() => this.$emit('close')"
                        >Close</md-button
                    >
                    <md-button class="md-primary" @click="$onSave"
                        >Save</md-button
                    >
                </md-dialog-actions>
            </md-dialog>
        </div>
    </div>
</template>

<script>
import FullScreenLayout from "./../../Layouts/FullScreenLayout";
import JetSectionBorder from "./../../Jetstream/SectionBorder";

import JetButton from "./../../Jetstream/Button";

var IzborDelaGradaModal = {
    components: {
        FullScreenLayout,
        JetSectionBorder,
        JetButton
    },
    props: [
        "idGrada",
        "showDialog",
        "cekiraneOpstineProp",
        "cekiraniDeloviOpstineProp"
    ],
    data() {
        return {
            opstine: [],
            cekiraneOpstine: [],
            cekiraniDeloviOpstine: [],
            isLoading: false
        };
    },
    methods: {
        async $onModalOpen() {
            this.isLoading = true;
            await axios
                .get(`/api/grad/${this.idGrada}/opstine/`)
                .then(response => (this.opstine = response.data));

            this.cekiraneOpstine = this.cekiraneOpstineProp.map(x => x);
            this.cekiraniDeloviOpstine = this.cekiraniDeloviOpstineProp.map(
                x => x
            );

            this.isLoading = false;
        },
        $onModalClose() {
            this.opstine = [];
            this.cekiraneOpstine = [];
            this.cekiraniDeloviOpstine = [];
            this.isLoading = false;
        },
        $onSave() {
            let cekiraneOpstineObj = this.opstine.filter(x =>
                this.cekiraneOpstine.includes(x.id)
            );

            for (var key in cekiraneOpstineObj) {
                let cekiraniDeloviOpstineObj = cekiraneOpstineObj[
                    key
                ].deloviOpstine.filter(x =>
                    this.cekiraniDeloviOpstine.includes(
                        `${cekiraneOpstineObj[key].id}-${x.id}`
                    )
                );

                cekiraneOpstineObj[
                    key
                ].deloviOpstine = cekiraniDeloviOpstineObj;
            }

            this.$emit("setCekiraneLokacije", cekiraneOpstineObj);

            this.$emit("close");
        },
        $afterCheckOpstina(idOpstine) {
            if (this.cekiraneOpstine.includes(idOpstine))
                this.checkAllDeloveOpstine(idOpstine);
            else this.uncheckAllDeloveOpstine(idOpstine);
        },
        $afterCheckDeoOpstine(idDelaOpstine) {
            let idOpstine = idDelaOpstine.split("-")[0];
            if (this.cekiraniDeloviOpstine.includes(idDelaOpstine)) {
                if (!this.cekiraneOpstine.includes(idOpstine))
                    this.cekiraneOpstine.push(idOpstine);
            } else {
                if (this.nijeCekiranNijedanDeoOpstine(idOpstine))
                    this.cekiraneOpstine = this.cekiraneOpstine.filter(
                        x => x != idOpstine
                    );
            }
        },
        nijeCekiranNijedanDeoOpstine(idOpstine) {
            let cekiraniDeloviOpstine = this.cekiraniDeloviOpstine.filter(x =>
                x.includes(idOpstine)
            );
            return cekiraniDeloviOpstine.length == 0;
        },
        checkAllDeloveOpstine(idOpstine) {
            let opstina = this.opstine.filter(x => x.id == idOpstine)[0];
            let _deloviOpstine = opstina.deloviOpstine;
            let cekiraniDeloviOpstine = this.cekiraniDeloviOpstine;
            let noviCekiraniDeloviOpstine = cekiraniDeloviOpstine.concat(
                _deloviOpstine?.map(x => `${idOpstine}-${x.id}`)
            );
            this.cekiraniDeloviOpstine = noviCekiraniDeloviOpstine.filter(
                onlyUnique
            );

            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }
        },
        uncheckAllDeloveOpstine(idOpstine) {
            this.cekiraniDeloviOpstine = this.cekiraniDeloviOpstine?.filter(
                x => !x?.includes(`${idOpstine}-`)
            );
        }
    }
};

export default IzborDelaGradaModal;
</script>
