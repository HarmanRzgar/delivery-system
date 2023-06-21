<template>
    <h1>Monthly Revenue</h1>
    <Bar
        id="my-chart-id"
        :options="chartOptions"
        :data="chartData"
        class="border border-4 border-gray-900 rounded-md m-4 resize-0.5 max-w-7xl bg-gray-800"
    />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {

    name: 'BarChart',
    components: { Bar },

    data() {
        return {
            chartData: {
                labels: [ 'January', 'February', 'March', 'April', 'May' ],
                datasets: [ { data: [40, 20, 12, 25, 46] } ],
                borderColor: '#36A2EB',
                backgroundColor: '#9BD0F5',
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
