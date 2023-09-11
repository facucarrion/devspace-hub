import { login } from './login'

interface RegisterProps {
  username: string
  email: string
  display_name: string | null
  password: string
  repeat_password: string
}

export async function register({
  username,
  email,
  display_name,
  password,
  repeat_password
}: RegisterProps) {
  const response = await fetch('http://127.0.0.1:8080/api/auth/register', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username,
      email,
      display_name,
      password,
      repeat_password
    })
  })

  const data = await response.json()

  const loginResponse = await login({ email, password })
    .then(res => res)
    .catch(err => err)

  return {
    registerData: response,
    loginResponse
  }
}
