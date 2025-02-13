Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'receipt-form',
      path: '/receipt-form',
      component: require('./components/Tool'),
    },
  ])
})
