import { verifyJwt } from "../jwt/verify";
import { logOut } from "../logOut";

export const isValidSession = async () => {
  if (!await verifyJwt() || !localStorage.getItem('user_id')) {
    logOut()
    return false
  } else {
    return true
  }
}