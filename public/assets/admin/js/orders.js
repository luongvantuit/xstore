async function updateOrder(orderId) {
  const response = await fetch("/api/admin/orders", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: Number(orderId),
      status: document.getElementById(`input-status-order-${orderId}`).value,
    }),
  });
  if (response.ok) {
    window.location.reload();
  }
}
