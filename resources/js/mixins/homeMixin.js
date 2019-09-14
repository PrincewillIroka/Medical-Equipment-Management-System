import { mapMutations } from 'vuex'
import SpinnerLayout from '../components/SpinnerLayout'
import Inventory from '../components/Inventory'
import BiomedicalEngineering from '../components/BiomedicalEngineering'
import ICU from '../components/ICU'
import Laboratory from '../components/Laboratory'
import Pathology from '../components/Pathology'
import Radiology from '../components/Radiology'
import Theatre from '../components/Theatre'

export default {
    components: {
        SpinnerLayout,
        Inventory,
        BiomedicalEngineering,
        ICU,
        Pathology,
        Theatre,
        Laboratory,
        Radiology
    },
    data() {
        return {
            toggleDepartmentsStatus: true,
            token: document
                .querySelector("meta[name='csrf-token']")
                .getAttribute('content'),
            allData: [],
            inventoryData: [],
            hasLoadedInventory: false
        }
    },

    computed: {
        activeTab: function() {
            return this.$store.getters.getActiveTab
        }
    },

    beforeMount() {},

    created() {
        this.fetchInventory()
    },

    mounted() {},

    methods: {
        ...mapMutations(['toogleActiveTab']),
        toggleDepartments() {
            this.toggleDepartmentsStatus = !this.toggleDepartmentsStatus
        },

        changeTab(tab) {
            this.toogleActiveTab(tab)
        },

        fetchInventory() {
            fetch('db', {
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json, text-plain, */*',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.token
                },

                method: 'post',
                body: JSON.stringify({
                    query_id: 'mKrTyR2e456'
                })
            })
                .then(response => response.json())
                .then(data => this.setInventoryData(data))
                .catch(err => {
                    console.error('Warning:', err)
                })
        },

        setInventoryData(data) {
            this.allData = data
            this.inventoryData = this.allData[0].inventory
            this.hasLoadedInventory = true
        }
    }
}
