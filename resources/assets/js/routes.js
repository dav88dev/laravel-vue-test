import DashboardComponent from './components/DashboardComponent'
import LoginComponent from './components/auth/LoginComponent'
import LogoutComponent from './components/auth/LogoutComponent'
import TeamsComponent from './components/TeamsComponent'
import PlayersComponent from './components/PlayersComponent'
import AddTeam from './components/AddTeam'
import AddPlayer from './components/AddPlayer'
import TeamPlayers from './components/TeamPlayers'
import EditTeam from './components/EditTeam'
import EditPlayer from './components/EditPlayer'


export const routes = [
    {
        path: '/',
        redirect: {name: 'login'}
    },
    {
        path: '/dashboard',
        redirect: '/dashboard/teams',
        name: 'dashboard',
        component: DashboardComponent,
        meta: {requiresAuth: true},
        children: [
            {
                path: '/dashboard/teams',
                name: 'teams',
                component: TeamsComponent

            },
            {
                path: '/dashboard/players',
                name: 'players',
                component: PlayersComponent
            },
            {
                path: '/dashboard/teams/:team/players',
                name: 'team-players',
                component: TeamPlayers
            },
            {
                path: '/dashboard/teams/add',
                name: 'add-team',
                component: AddTeam
            },
            {
                path: '/dashboard/players/add',
                name: 'add-player',
                component: AddPlayer
            },
            {
                path: '/dashboard/player/:team/edit',
                name: 'edit-team',
                component: EditTeam
            },
            {
                path: '/dashboard/player/:player/edit',
                name: 'edit-player',
                component: EditPlayer
            },
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





