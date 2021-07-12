<template lang="">
    <div>
        <div class='card' :style="{'background-image':'url('+hero.thumb+')'}">
            <button v-if="!hero.loading" class="close" @click="deleteHero(hero.id)">✖</button>
            <div class='card-text'>
                {{ hero.name }}
                <div class='card-sub-text'>{{ hero.description == null ? 'Carregando...' : hero.description }}</div>
                Stories
                <div v-if="!hero.loadStore">
                    <div v-for="(item, index) in hero.stories" :key="index" class='card-sub-text stories-text'>
                        {{ index+1 }} - {{ item.title }}
                    </div>
                </div>
                <div v-if="hero.loadStore">
                    Loading Stories...
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        hero: Object,
        deleteHero: Function
    },
}
</script>
<style lang="css">
    .card {
        cursor: pointer;
        position: relative;
        width: 400px;
        height: 550px;
        background: #887685;
        border-radius: 10px;
        background-size: cover;
    }

    .card-text {
        position: absolute;
        z-index: 1;
        bottom: -10px;
        left: 0;
        background-color: rgba(0,0,0,0.7);
        width: 100%;
        border-radius: 10px;
        height: 50px;
        text-align: center;
        align-items: center;
        color: white;
        font-weight: bold;
        font-size: 25px;
        line-height: 2.5;
        margin-bottom: 10px;
        overflow: hidden;        
    }

    .card-sub-text {
        padding: 10px;
        font-size: 12px;
        font-weight: 200;
        line-height: 1.3;        
    }

    .stories-text {
        line-height: 0.8;   
    }

    .card:hover .card-text{
        height: 90%;
    }
    

    /* Customizando layout responsivo */
    @media screen and (max-width: 1250px) {
        .card {
            margin-bottom: 40px;
            width: 100%;
        }
    }
</style>