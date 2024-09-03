import Layout from './Layout'
import { Head } from '@inertiajs/react'

export default function Welcome({ user }) {
  return (
    <Layout>
      <Head title="Welcome Page" />
      <h1>Welcome Nusara HRM</h1>
      <p>Hello {user.name}, welcome to your first Inertia app From Nusara HRM Packages!</p>
    </Layout>
  )
}
