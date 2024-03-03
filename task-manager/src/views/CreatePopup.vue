<template>
    <div class="popup-overlay">
        <div class="popup-content">
            <div class="task-form">
                <h2>Создать новую задачу</h2>
                <input type="text" v-model="newTask.title" placeholder="Название задачи" class="input-field">
                <textarea v-model="newTask.description" placeholder="Описание задачи" class="textarea-field"></textarea>
                <select v-model="newTask.status" class="select-field">
                    <option value="Todo">Todo</option>
                    <option value="InProgress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <button @click="createTask" class="btn btn-primary">Создать задачу</button>
            <button @click="cancelCreate" class="btn btn-secondary">Отмена</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newTask: {
                title: '',
                description: '',
                status: 'Todo',
                created_at: '',
            },
        };
    },
    methods: {
        createTask() {
            this.$emit('create-task', { ...this.newTask });
            this.closeCreatePopup();
        },
        cancelCreate() {
            this.closeCreatePopup();
        },
        closeCreatePopup() {
            this.$emit('close-create-popup');
        }
    }
};
</script>

<style scoped>
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.input-field,
.textarea-field,
.select-field {
    margin-bottom: 16px;
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}
button.btn-secondary {
    margin-left: 15px;
}
</style>
