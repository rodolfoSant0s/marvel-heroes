<template lang="">
    <div>
        <div class="show-storie">
        <button class="close">✖</button>
        </div>        
    </div>
</template>
<script>
export default {
    props: {
        hero: Object,
        heroStorie: Object
    }
}
</script>
<style lang="css">
    .show-storie{
        position: absolute;
        left: 0;
        bottom: 0;
        background: white;
        height: 0%;
        width: 100%;
        z-index: 2;
        transform: all(0.2s);      
    }

    .close {
        cursor: pointer;
        width: 35px;
        font-size: 35px;
        color: #c0c5cb;
        align-self: flex-end;
        background-color: transparent;
        border: none;
        margin-bottom: 10px;
        float: right;
        margin: 15px;
    }      
</style>