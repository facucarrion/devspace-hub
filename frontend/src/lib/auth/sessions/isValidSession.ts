import { verifyJwt } from "../jwt/verify";

export const isValidSession = async () => {
  if (!await verifyJwt() || !localStorage.getItem('user_id')) {
    return false
  } else {
    return true
  }
}