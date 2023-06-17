<script>
new Vue({
    el: '#hf-main',
    data: {
        homepage: true,
        itemLinks: [
            { title: 'Home', link: './' },
            {
                title: 'Diensten',
                link: './diensten',
                subItems: [
                    { title: 'Elektromontage', link: './elektromontage' },
                    { title: 'Installatietechniek', link: './installatietechniek' },
                    { title: 'Schoonmaak', link: './schoonmaak' },
                    { title: 'Overige diensten', link: './overige-diensten' },
                ],
            },
            { title: 'Over H&F', link: './over-hf' },
            { title: 'Contact', link: './contact' },
        ],
    },
})
</script>

<nav id="hf-nav">
<template v-for="item in itemLinks">
    <a :href="`${item.link}`">{{ item.title }}</a>
    <nav v-if="item.subItems">
        <a v-for="sub in item.subItems" :href="`${sub.link}`">{{ sub.title }}</a>
    </nav>
</template>
</nav>
