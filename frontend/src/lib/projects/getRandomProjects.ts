export async function getRandomProjects(limit: number, ownUser: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/random/${ownUser}?limit=${limit}`);
  const data = await response.json();
  return data;
}