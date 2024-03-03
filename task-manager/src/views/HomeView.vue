<template>
    <div class="home">
        <div class="container">
            <img alt="Vue logo" src="../assets/logo.png" class="logo">
            <h1 class="title">Добро пожаловать в ваше Vue.js приложение</h1>
            <p class="description">Это пример красивой главной страницы</p>
            <router-link to="/task-list" class="btn btn-dark">Перейти к списку задач</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HomeView',
}
</script>

<style scoped>
.home {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f4f6;
}

.container {
    text-align: center;
}

.logo {
    width: 100px;
    height: 100px;
}

.title {
    font-size: 2.5rem;
    margin-top: 1rem;
}

.description {
    font-size: 1.2rem;
    color: #6b7280;
}
</style>
