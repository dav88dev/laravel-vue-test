
import DashboardComponent from './components/DashboardComponent'
import LoginComponent from './components/auth/LoginComponent'
import LogoutComponent from './components/auth/LogoutComponent'
import TeamsComponent from './components/TeamsComponent'
import PlayersComponent from './components/PlayersComponent'


export const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/dashboard',
        redirect: '/dashboard/teams',
        name: 'dashboard',
        component: DashboardComponent,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/dashboard/teams',
                name: 'teams',
                component:TeamsComponent

            },
            {
                path: '/dashboard/players',
                name: 'players',
                component: PlayersComponent
            }
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/logout',
        name: 'logout',
        component: LogoutComponent
    },
]





