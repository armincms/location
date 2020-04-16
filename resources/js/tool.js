Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'location',
      path: '/location',
      component: require('./components/Tool'),
    },
  ])
})
