import { jwtVerify } from "jose";
import { getUserToken } from "../helpers/getUserToken";

export async function verifyJwt() {
  const token = localStorage.getItem('jwt');

  if (!token) return false
  
  try {
    const jwtSecret = await getUserToken()
    const { payload } = await jwtVerify(token, new TextEncoder().encode(jwtSecret))

    console.log('se hizo')

    if (payload) {
      return true
    }

    return false
  } catch (error) {
    console.log('error')
    console.error(error)
    return false
  }

  return false
}