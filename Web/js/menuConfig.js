var menu = [
    {
        id: 'home',
        title: 'Home',
        icon: 'home',
        url: 'dashboard.php',
        color: '#F44336',
        subItems: []
    },
    {
        id: 'dashboard',
        title: 'Gestion de usuarios',
        icon: 'users-cog',
        url: 'dashboard.html',
        color: '#6A0DAD',
        subItems: [
            {
                id: 'profesores',
                title: 'Profesores',
                url: 'gestion_profesores.php'
            },
            {
                id: 'alumnos',
                title: 'Alumnos',
                url: 'gestion_alumnos.php'
            }
        ]
    },
    {
        id: 'security',
        title: 'Gestion de materias',
        icon: 'tools',
        url: 'security.html',
        color: '#20B2AA',
        subItems: []
    },
    {
        id: 'settings',
        title: 'Settings',
        icon: 'cog',
        url: 'settings.html',
        color: '#2196F3',
        subItems: []
    },
];
