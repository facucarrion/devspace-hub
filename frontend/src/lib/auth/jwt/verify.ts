import { jwtVerify } from "jose";

export async function verifyJwt() {
  const token = localStorage.getItem('jwt');

  if (!token) return false
  
  try {
    const jwtSecret = localStorage.getItem('jwt_secret') ?? ''
    const { payload } = await jwtVerify(token, new TextEncoder().encode(jwtSecret))

    if (payload) {
      return true
    }

    return false
  } catch (error) {
    console.error(error)
    return false
  }
}