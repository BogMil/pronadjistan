<template>
    <md-card style="margin-bottom:10px">
        <md-card-header style="padding-bottom:5px;padding-top:5px">
            <md-card-header-text>
                <div class="md-subhead">
                    <slot name="header"></slot>
                </div>
            </md-card-header-text>
        </md-card-header>

        <md-card-content style="padding-bottom:5px">
            <slot></slot>
        </md-card-content>
    </md-card>
</template>

<script>
export default {
    props: ["title"]
};
</script>
