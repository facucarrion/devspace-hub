import { login } from './login'

export async function register(formData: FormData) {
  const response = await fetch('http://127.0.0.1:8080/api/auth/register', {
    method: 'POST',
    body: formData
  })

  const data = await response.json()

  const loginResponse = await login({
    email: formData.get('email') as string,
    password: formData.get('password') as string
  })
    .then(res => res)
    .catch(err => err)

  return {
    registerData: response,
    loginResponse
  }
}
