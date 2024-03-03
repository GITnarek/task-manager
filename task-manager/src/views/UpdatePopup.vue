<template>
    <div class="popup-overlay">
        <div class="popup-content">
            <h2>Редактировать задачу</h2>
            <input type="text" v-model="editedTask.title" placeholder="Название задачи" class="input-field">
            <textarea v-model="editedTask.description" placeholder="Описание задачи" class="textarea-field"></textarea>
            <select v-model="editedTask.status" class="select-field">
                <option value="Todo">Todo</option>
                <option value="InProgress">In Progress</option>
                <option value="Done">Done</option>
            </select>
            <button @click="updateTask" class="btn btn-primary m-lg-1">Обновить задачу</button>
            <button @click="cancelEdit" class="btn btn-secondary">Отмена</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['task'],
    data() {
        return {
            editedTask: { ...this.task }
        };
    },
    methods: {
        updateTask() {
            this.$emit('update-task', { ...this.editedTask });
            this.closePopup();
        },
        cancelEdit() {
            this.closePopup();
        },
        closePopup() {
            this.$emit('close-popup');
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
    padding: 20px;
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
</style>
