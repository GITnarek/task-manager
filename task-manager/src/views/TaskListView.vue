<template>
    <div class="task-list-page">
        <div class="actions">
            <div>
                <router-link to="/" class="btn btn-primary">Назад к главной странице</router-link>
            </div>
            <div class="create-task-action">
                <button class="btn btn-success" @click="openCreatePopup()">Создать задачу</button>
            </div>
        </div>
        <h2>Список задач</h2>
        <div class="status-filter">
            <label for="status">Фильтр по статусу:</label>
            <select id="status" v-model="selectedStatus">
                <option value="all">All</option>
                <option value="Todo">Todo</option>
                <option value="InProgress">In Progress</option>
                <option value="Done">Done</option>
            </select>
        </div>
        <table class="task-table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Дата создания задачи</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in filteredTasks" :key="task.id" class="task-item">
                <td>{{ task.title }}</td>
                <td>{{ task.description }}</td>
                    <td>
                        <span :class="getStatusColor(task.status)"> {{ task.status }}</span>
                    </td>
                <td>{{ formatCreatedAt(task.created_at) }}</td>
                <td>
                  <button @click="openEditPopup(task)" class="btn btn-primary">Редактировать</button>
                  <button @click="deleteTask(task.id)" class="btn btn-danger m-1">Удалить</button>
                </td>
            </tr>
            </tbody>
        </table>
        <updatePopup v-if="selectedTask" :task="selectedTask" @update-task="updateTask" @close-popup="closePopup"></updatePopup>
        <createPopup v-if="showCreatedPopup" @create-task="createTask" @close-create-popup="closeCreatePopup"></createPopup>
    </div>
</template>

<script>
import updatePopup from './UpdatePopup';
import createPopup from './CreatePopup';
import http from '../../http';

export default {
    components: {
        updatePopup,
        createPopup,
    },
    data() {
        return {
            tasks: [],
            newTask: {
                title: '',
                description: '',
                status: 'todo',
                created_at: '',
            },
            selectedTask: null,
            showCreatedPopup: false,
            csrfToken: null,
            error: null,
            selectedStatus: 'all'
        };
    },
    mounted() {
        this.fetchCsrfToken();
    },
    created() {
        this.loadTasks();
    },
    methods: {
        fetchCsrfToken() {
            http.get('/csrf-token')
                .then(response => {
                    this.csrfToken = response.data.csrf_token;
                    http.defaults.headers.common['X-CSRF-TOKEN'] = this.csrfToken;
                })
                .catch(error => {
                    console.error('Error fetching CSRF token: ', error);
                });
        },
        loadTasks() {
            http.get('/tasks')
                .then(response => {
                    this.tasks = response.data;
                })
                .catch(error => {
                    console.error('Error fetching tasks: ', error);
                    this.error = 'Ошибка при загрузке задач.';
                });
        },
        createTask(newTask) {
            const config = {
                headers: {
                    'X-CSRF-Token': this.csrfToken
                }
            };
            if (!newTask.title.trim()) {
                return;
            }

            http.post('/tasks', newTask, config.value)
                .then(response => {
                    this.tasks.push(response.data);
                    newTask = {
                        title: '',
                        description: '',
                        status: 'todo',
                    };
                    this.showCreatedPopup = false;
                })
                .catch(error => {
                    console.error('Error creating task: ', error);
                    this.error = 'Ошибка при создании задачи.';
                });
        },
        updateTask(updatedTask) {
            const config = {
                headers: {
                    'X-CSRF-Token': this.csrfToken
                }
            };
            http.put(`/tasks/${updatedTask.id}`, updatedTask, config.value)
                .then(() => {
                    const index = this.tasks.findIndex(t => t.id === updatedTask.id);
                    if (index !== -1) {
                        this.tasks.splice(index, 1, updatedTask);
                    }
                    this.selectedTask = null;
                })
                .catch(error => {
                    console.error('Error updating task: ', error);
                    this.error = 'Ошибка при обновлении задачи.';
                });
        },
        deleteTask(taskId) {
            http.delete(`/tasks/${taskId}`)
                .then(() => {
                    this.tasks = this.tasks.filter(task => task.id !== taskId);
                })
                .catch(error => {
                    console.error('Error deleting task: ', error);
                    this.error = 'Ошибка при удалении задачи.';
                });
        },
        closePopup() {
            this.selectedTask = null;
        },
        closeCreatePopup() {
            this.showCreatedPopup = false;
        },
        formatCreatedAt(date) {
            return new Date(date).toLocaleString();
        },
        openEditPopup(task) {
            this.selectedTask = {...task};
        },
        openCreatePopup() {
            this.showCreatedPopup = true;
        },
        getStatusColor(status) {
            if (status === 'InProgress') {
                return 'badge bg-dark';
            } else if (status === 'Done') {
                return 'badge bg-success';
            } else {
                return 'badge bg-warning';
            }
        }
    },
    computed: {
        filteredTasks() {
            if (this.selectedStatus === 'all') {
                return this.tasks;
            } else {
                return this.tasks.filter(task => task.status === this.selectedStatus);
            }
        }
    }
};
</script>

<style scoped>
.task-list-page {
    text-align: center;
    margin-top: 20px;
}

.task-table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

.task-table th,
.task-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.task-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.task-table tbody tr:hover {
    background-color: #f5f5f5;
}

.task-form {
    margin-top: 40px;
}

.task-form h2 {
    margin-bottom: 10px;
}

.task-form input,
.task-form textarea {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.task-form button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.task-form button:hover {
    background-color: #0056b3;
}
.task-table td, .task-table th {
    text-align: left;
}

.task-list-page {
    padding: 0 20px;
}
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.status-filter {
    display: flex;
    align-items: center;
    padding: 5px;
}

.status-filter label {
    margin-right: 10px;
}

.status-filter select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}
</style>
