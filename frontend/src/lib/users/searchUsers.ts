export async function searchUsers(name: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/search?q=${name}`);
  const data = await response.json();
  return data;
}