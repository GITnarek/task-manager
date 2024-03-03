import { createStore } from 'vuex'

export default createStore({
    state: {
        tasks: [] // Пример состояния для хранения задач
    },
    getters: {
        // Пример геттера для получения всех задач
        allTasks: state => state.tasks
    },
    mutations: {
        // Пример мутации для добавления задачи в состояние
        addTask(state, task) {
            state.tasks.push(task);
        }
    },
    actions: {
        // Пример действия для добавления задачи
        addNewTask({ commit }, newTask) {
            commit('addTask', newTask);
        }
    }
})
