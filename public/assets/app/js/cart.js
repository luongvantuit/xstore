async function addToCart(propertyId, quantity) {
  const accessToken = await localStorage.getItem("accessToken");
  const response = await fetch("/api/cart-product", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
    },
    body: JSON.stringify({
      property_id: propertyId,
      number: quantity,
    }),
  });

  if (response.ok) {
    window.location.reload();
  }
}

async function removeFromCart(propertyId) {
  const accessToken = await localStorage.getItem("accessToken");
  const response = await fetch(`/api/cart-product/?property_id=${propertyId}`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
    },
  });
  if (response.ok) {
    window.location.reload();
  }
}

async function minusCart(propertyId, number_current) {
  const accessToken = await localStorage.getItem("accessToken");
  const response = await fetch(
    `/api/cart-product?property_id=${propertyId}&number=${number_current - 1}`,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${accessToken}`,
      },
    }
  );
  if (response.ok) {
    window.location.reload();
  }
}

async function plusCart(propertyId, number_current) {
  const accessToken = await localStorage.getItem("accessToken");
  const response = await fetch(
    `/api/cart-product?property_id=${propertyId}&number=${number_current + 1}`,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${accessToken}`,
      },
    }
  );
  if (response.ok) {
    window.location.reload();
  }
}

async function updateCart(propertyId, quantity) {
  const accessToken = await localStorage.getItem("accessToken");
  const response = await fetch(
    `/api/cart-product?property_id=${propertyId}&number=${quantity}`,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${accessToken}`,
      },
    }
  );
  if (response.ok) {
    window.location.reload();
  }
}
