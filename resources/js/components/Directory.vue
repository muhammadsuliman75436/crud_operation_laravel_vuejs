<template>
    <div>
        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" v-model="item.name" class="form-control" name="name" id="name"
                   placeholder="e.g John Doe">
        </div>
        <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="tel" v-model="item.phone" class="form-control" name="phone" id="phone" placeholder="Contact">
        </div>
        <br>
        <button type="submit" @click="save" class="btn btn-success btn-block" style="width: 100%">
            {{ isEditing ? 'Update' : 'Save' }}
        </button>
        <br>
        <div class="container" v-if="lists.length > 0">
            <h2 class="text-center mt-3">Contact List</h2>
            <ul class="list-group list-group-flush" v-for="item in lists">
                <li class="list-group-item" :key="item.id">{{ item.name }} - {{ item.phone }}
                    <span class="float-right">
                        <button class="btn btn-sm btn-warning" @click="editTel(item)">Edit</button>
                        <button class="btn btn-sm btn-danger" @click="deleteTell(item.id)">Delete</button>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Directory",
    data() {
        return {
            lists: [],
            item: {
                name: "",
                phone: "",
            },
            temp_id: null,
            isEditing: false,
        }
    },
    methods: {
        fetchAll() {
            axios.get('api/tell').then(res => this.lists = res.data);
        },
        save() {
            let method = axios.post;
            let url = 'api/tell';

            if(this.isEditing){
                method = axios.put;
                url = `api/tell/${this.temp_id}`;
            }
            try {
                method(url, this.item).then((res) => {
                    this.fetchAll();
                    this.item.name = "";
                    this.item.phone = "";
                    this.isEditing = false;
                    this.temp_id = null;
                });
            } catch (e) {
                console.log(e)
            }
        },
        deleteTell(id) {
            try {
                axios.delete(`api/tell/${id}`).then(res => this.fetchAll());
            } catch (e) {
                console.log(e)
            }
        },
        editTel(tel) {
            this.item = {
                name: tel.name,
                phone: tel.phone,
            };
            this.isEditing = true;
            this.temp_id = tel.id;
        }
    },
    mounted() {
        this.fetchAll();
    }
}
</script>

<style scoped>

</style>
