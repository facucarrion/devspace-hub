import { jwtVerify } from "jose";
import { getUserToken } from "../helpers/getUserToken";

interface Props {
  token: string;
}

export async function decodeJWT({ token }: Props) {
  const tokenKey = await getUserToken()

  try {
    const {
      payload: { exp, iat, ...decoded },
    } = await jwtVerify(token, new TextEncoder().encode(await tokenKey))
    
    return decoded;
  } catch (error) {
    console.error(error);
    return null;
  }
}