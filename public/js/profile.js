tailwind.config = {
    theme: {
        extend: {
            colors: {
                'agri-green': {
                    100: '#e6f4e6',
                    200: '#c8e6c9',
                    300: '#a5d6a7',
                    400: '#81c784',
                    500: '#4caf50',
                    600: '#43a047',
                    700: '#2e7d32',
                    800: '#1b5e20',
                    900: '#0d3d0d'
                },
                'earth': {
                    100: '#f5efe0',
                    500: '#b8977e',
                    700: '#7d5e4a'
                }
            },
            fontFamily: {
                'sf-pro': ['SF Pro Display', 'SF Pro', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI',
                    'Roboto', 'sans-serif'
                ]
            },
            boxShadow: {
                'profile': '0 10px 40px rgba(46, 125, 50, 0.1), 0 5px 20px rgba(76, 175, 80, 0.07)',
                'badge': '0 4px 12px rgba(46, 125, 50, 0.15)',
                'elevated': '0 15px 50px rgba(46, 125, 50, 0.12), 0 10px 30px rgba(76, 175, 80, 0.1)'
            }
        }
    }
}
