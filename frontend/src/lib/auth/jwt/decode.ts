import { jwtVerify } from "jose";

interface Props {
  token: string;
}

export async function decodeJWT({ token }: Props) {
  const tokenKey = localStorage.getItem('jwt_secret') as string;

  try {
    const {
      payload
    } = await jwtVerify(token, new TextEncoder().encode(tokenKey))
    
    return payload;
  } catch (error) {
    return null;
  }
}