<template>
    <div class="container">
        <div>
            <li class="nav-item dropdown"> 
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg>
                        Thông báo <span class="w3-badge">{{notifications.length}}</span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu"> 
                        <li v-for="notification in notifications" class="noti">
                                    <a href="/index_notification" @click="MarkAsread(notification)" >
                                    <h5 v-html="notification.data.title "></h5>
                                    </a>
                                    <small>Nội dung: <h6 v-html="notification.data.content"></h6></small>
                                    <small>Email: <span v-html="notification.data.email"></span></small>
                                    <hr>
                        </li>
                        <li v-if="notifications.length == 0">
                                Không có thông báo
                        </li>
                    </ul>
            </li>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
        export default {
            data(){
                return{
                    bgColor: 'white',
                }
            },
            props:['notifications'],
            methods: {
                MarkAsread: function(notification){
                    var data = {
                        id: notification.id,
                    };
                    axios.post('/index_notification/read', data).then(response => {
                        window.location.href = "/index_notification/"
                    })
                },
        }
    }
</script>

<style scoped>
    .w3-badge {
        display: inline-block;
        min-width: 17px;
        padding: 0px 4px;
        border-radius: 50%;
         font-size: 12px;
         text-align: center;
        background: #1779ba;
        color: #fefefe;
    }
    .noti{
         width:max-content;
         text-decoration: none;
         display:block;
    }
    .dropdown-menu{
        margin: 0px -81px;
        padding: 14px;
    }
</style>