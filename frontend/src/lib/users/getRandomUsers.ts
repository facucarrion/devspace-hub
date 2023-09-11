

export async function getRandomUsers(limit: number) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/random/${limit}`);
  const data = await response.json();

  return data;
}